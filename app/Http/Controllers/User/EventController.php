<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Event;
use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Relationship;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', true)->limit(4)->orderBy("created_at")->get();
    
        foreach ($events as $event) {
            $total = $event->registration->count();
            $event->totalResgist = $total;
        }
    
        return view('user.index', [
            'events' => $events,
        ]);
    }

    public function event()
    {
        $events = Event::where('status', true)->get();

        foreach ($events as $event) {
            $total = $event->registration->where("status", "approved")->count();
            $event->totalResgist = $total;
        }

        return view('user.event', [
            'events' => $events,
        ]);
    }
    
    public function detail($slug)
    {
        $event = Event::where('slug', $slug)->first();
        
        if (! $event) {
            abort(404);
        }
        
        return view('user.detail-event', [
            'event' => $event,
        ]);
    }
    
    public function category($slug)
    {
        $category = Category::where("slug", $slug)->first();
        $events  = Event::where("category_id", $category->id)->get();

        return view('user.event', [
            'events' => $events,
        ]);
    }
    
    public function registEvent(Request $request)
    {
        $data = $request->validate([
            "event_id" => "required"
        ]);

        if (!Auth::guard("user")->check()) {
            return redirect()->route("login");
        }

        $event = Event::findOrFail($request->event_id);
        $user_id = Auth::guard("user")->user()->id;

        if (!$event->reg_open_at <= now() && !$event->reg_close_at >= now()) {
            return redirect()->back()->withErrors("error", "Pendaftaran sudah berakhir");
        };

        if ($event->quota >= 0) {
            $coupon = Coupon::where("code", $request->code)->first();

            $final_price = $event->price;

            if ($coupon) {
                if($coupon->open_at <= now() && $coupon->closed_at >= now()) {
                    if ($coupon->discount_type == "flat") {
                        $discount = $final_price - $coupon->discount_value;
    
                        $final_price = $discount;
                    } else {
                        $precentDiscount = $final_price * $coupon->discount_value / 100;
                        $dicsount = $final_price - $precentDiscount;
    
                        $final_price = $dicsount;
                    }
                } else {
                    return redirect()->back()->with("error", "Coupon melewati batas tanggal penggunaan");
                }
            }

            $code_registration = strtoupper(Str::random(10));
            
            while(Registration::where("code_registration", $code_registration)->exists()) {
                $code_registration = strtoupper(Str::random(10));
            }

            $data = [
                "code_registration" => $code_registration,
                "user_id" => $user_id,
                "event_id" => $event->id,
                "coupon_id" => $coupon->id ?? null,
                "status" => "pending",
                "final_price" => $final_price,
            ];

            $quota = $event->quota - 1;
            
            $event->update([
                "quota" => $quota
            ]);

            $registration = Registration::create($data);

            if ($registration) {
                return redirect()->route("payment.event", $registration->code_registration);
            }
        } else {
            return redirect()->route("event");
        }
    }

    public function paymentEvent($code_registration)
    {
        $registration = Registration::where("code_registration", $code_registration)->first();

        if(!$registration) {
            abort(404);
        }

        return view("user.payment", [
            "registration" => $registration
        ]);
    }

    public function paymentProof(Request $request, Registration $registration)
    {
        $data = $request->validate([
            "payment_proof" => "required|image|mimes:jpg,jepg,png,webp,gif,jfif|max:2048"
        ]);

        $file = $data['payment_proof'];
        $filename = time() ."-". $file->getClientOriginalName();
        $path = "images/payment/";

        $file->storeAs($path, $filename);
        
        $registration->update([
            "payment_proof" => $filename
        ]);

        if($registration) {
            return redirect()->back()->with("success", "berhasil membayar");
        }
    }

    public function history()
    {
        if(!Auth::guard("user")->check()) {
            return redirect()->route("login");
        }
        
        $histories = Registration::where("user_id", Auth::guard("user")->user()->id)->orderByDesc("created_at")->paginate(10);

        return view("user.history", [
            "histories" => $histories
        ]);
    }


































    // public function registEvent(Request $request)
    // {
    //     if(!Auth::guard("user")->check()) {
    //         return redirect()->route("login");
    //     }

    //     $event = Event::find($request->event_id);

    //     if ($event->quota >= 0) {

    //         $coupon = Coupon::where('code', $request->code)->first();
    //         $final_price = $event->price;
    //         $user_id = Auth::guard('user')->user()->id;

    //         if ($coupon && $coupon->is_active == true) {
    //             $coupon_id = $coupon->id;

    //             if ($coupon->discount_type == 'flat') {
    //                 $final_price = $event->price - $coupon->discount_value;
    //             } else {
    //                 $discount = $event->price * $coupon->discount_value / 100;
    //                 $final_price = $event->price - $discount;
    //             }
    //         }

    //         $data = [
    //             'user_id' => $user_id,
    //             'event_id' => $event->id,
    //             'coupon_id' => $coupon_id ?? null,
    //             'status' => 'pending',
    //             'final_price' => $final_price,
    //         ];

    //         $registration = Registration::create($data);

    //         $event_quota = $event->quota - 1;

    //         $event->update([
    //             'quota' => $event_quota,
    //         ]);

    //         if ($registration) {
    //             return redirect()->route('event')->with('success', 'berhasil daftar event');
    //         }

    //     } else {
    //         return redirect()->route('event')->with('error', 'quota sudah habis');
    //     }
    // }
}
