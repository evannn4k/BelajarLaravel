<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminEventCreateRequest;
use App\Http\Requests\Admin\AdminEventUpdateRequest;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view("admin.event.index", [
            "events" => $events
        ]);
    }

    public function create()
    {
        return view("admin.event.create");
    }

    public function store(AdminEventCreateRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data["title"]);
        
        $counter = 1;

        while(Event::where("slug", $slug)->exists()) {
            $slug = $slug ."-". $counter;
            $counter++;
        }

        $data["slug"] = $slug;
        
        $event = Event::create($data);
        
        if($event)
        {
            return redirect()->route("admin.event.index")->with("success", "Berhasil menambahkan event");
        }
    }
    
    public function edit($event)
    {
        $event = Event::where("slug", $event)->first();
        
        if(!$event) {
            return abort(404);
        }

        return view("admin.event.edit", ["event" => $event]);
    }
    
    public function update(AdminEventUpdateRequest $request, $event)
    {
        $data = $request->validated();
        
        $event = Event::where("slug", $event)->first();
        
        $slug = Str::slug($data["title"]);
        $counter = 1;
        while(Event::where("slug", $slug)->where("id", "!=" ,$event->id)->exists()) {
            $slug = $slug ."-". $counter;
            $counter++;
        }
        $data["slug"] = $slug;
        
        $update = $event->update($data);
        
        if($update) {
            return redirect()->route("admin.event.index")->with("success", "Berhasil mengubah event");
        }
    }
    
    public function delete($event)
    {
        $event = Event::where("slug", $event)->first();
        
        $delete = $event->delete();
        
        if($delete) {
            return redirect()->route("admin.event.index")->with("success", "Berhasil menghapus event");
        }
    }
}
