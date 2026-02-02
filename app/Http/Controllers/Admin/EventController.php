<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryEvent;
use App\Models\Event;
use App\Models\Registration;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('admin.event.index', [
            'events' => $events,
        ]);
    }

    public function detail($slug)
    {
        $event = Event::where('slug', $slug)->first();

        return view('admin.event.detail', [
            'event' => $event,
        ]);
    }

    public function create()
    {
        $categories = CategoryEvent::all();
        return view('admin.event.create', [
            "categories" => $categories
        ]);
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required|min:1',
            'quota' => 'required|min:1',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jepg,png,jfif,webp,gif|max:2048',
            'event_date' => 'required|date',
            'reg_open_at' => 'required|date',
            'reg_close_at' => 'required|date',
        ]);
        
        $file = $request->file("image");
        $filename = time() ."-". $file->getClientOriginalName();
        $path = "images/event/";
        
        $file->storeAs($path, $filename);
        $data["image"] = $filename;
        
        $slug = Str::slug($data['title']);
        
        $counter = 1;
        
        while (Event::where('slug', $slug)->exists()) {
            $slug = $slug.'-'.$counter;
            $counter++;
        }
        
        $data['slug'] = $slug;
        
        $event = Event::create($data);
        
        if ($event) {
            return redirect()->route('admin.event.index')->with('success', 'Berhasil menambahkan event');
        }
    }
    
    public function edit($event)
    {
        $event = Event::where('slug', $event)->first();
        
        if (! $event) {
            return abort(404);
        }
        
        $categories = CategoryEvent::all();
        return view('admin.event.edit', [
            "categories" => $categories,
            'event' => $event
        ]);
    }
    
    public function update(Request $request, $event)
    {

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required|min:1',
            'quota' => 'required|min:1',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jepg,png,jfif,webp,gif|max:2048',
            'event_date' => 'required|date',
            'reg_open_at' => 'required|date',
            'reg_close_at' => 'required|date',
        ]);

        $event = Event::where('slug', $event)->first();
        
        if($request->file("image")) {
            $file = $request->file("image");
            $path = "images/event/";
            $filename = time() ."-". $file->getClientOriginalName();

            Storage::delete($path.$event->image);

            $file->storeAs($path, $filename);
            $data["image"] = $filename;
        }
        
        $slug = Str::slug($data['title']);
        $counter = 1;
        while (Event::where('slug', $slug)->where('id', '!=', $event->id)->exists()) {
            $slug = $slug.'-'.$counter;
            $counter++;
        }

        $data['slug'] = $slug;

        $update = $event->update($data);

        if ($update) {
            return redirect()->route('admin.event.index')->with('success', 'Berhasil mengubah event');
        }
    }

    public function delete($event)
    {
        $event = Event::where('slug', $event)->first();

        $delete = $event->delete();

        if ($delete) {
            return redirect()->route('admin.event.index')->with('success', 'Berhasil menghapus event');
        }
    }

    public function registerApproved($id)
    {
        Registration::findOrFail($id)->update([
            'status' => 'Approved',
        ]);

        return back();
    }

    public function registerDelete($id)
    {
        $registration = Registration::findOrFail($id);

        if ($registration->payment_proof) {
            $path = "images/payment/";
            
            Storage::delete($path . $registration->payment_proof);
        }

        $registration->delete();

        if ($registration) {
            return back();
        }
    }
}   
