<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('status', true)->get();
        
        foreach($events as $event) {
            $total = $event->registration->count();
            $event->totalResgist = $total;
        }

        return view('user.index', [
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

    public function registEvent(Request $request)
    {

        if(!Auth::guard("user")->check()) {
            return redirect()->route("login");
        }

        $event = Event::find($request->event_id);

        if ($event->quota >= 0) {

            $coupon = Coupon::where('code', $request->code)->first();
            $final_price = $event->price;
            $user_id = Auth::guard('user')->user()->id;

            if ($coupon && $coupon->is_active == true) {
                $coupon_id = $coupon->id;

                if ($coupon->discount_type == 'flat') {
                    $final_price = $event->price - $coupon->discount_value;
                } else {
                    $discount = $event->price * $coupon->discount_value;
                    $final_price = $event->price - $discount;
                }
            }

            $data = [
                'user_id' => $user_id,
                'event_id' => $event->id,
                'coupon_id' => $coupon_id ?? null,
                'status' => 'pending',
                'final_price' => $final_price,
            ];

            $registration = Registration::create($data);

            $event_quota = $event->quota - 1;

            $event->update([
                'quota' => $event_quota,
            ]);

            if ($registration) {
                return redirect()->route('index')->with('success', 'berhasil daftar event');
            }

        } else {
            return redirect()->route('index')->with('error', 'quota sudah habis');
        }
    }
}
