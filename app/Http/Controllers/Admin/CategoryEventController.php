<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryEventController extends Controller
{
    public function index()
    {
        $categories = CategoryEvent::all();

        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $slug = Str::slug($data['name']);

        $counter = 1;

        while (CategoryEvent::where('slug', $slug)->exists()) {
            $slug = $slug.'-'.$counter;
            $counter++;
        }

        $data['slug'] = $slug;

        $category = CategoryEvent::create($data);

        if ($category) {
            return redirect()->route('admin.category-event.index')->with('success', 'Berhasil menambahkan category');
        }
    }
    
    public function edit($category)
    {
        $category = CategoryEvent::where('slug', $category)->first();
        
        if (! $category) {
            return abort(404);
        }
        
        return view('admin.category.edit', ['category' => $category]);
    }
    
    public function update(Request $request, $category)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        
        $category = CategoryEvent::where("slug", $category)->first();
        
        $slug = Str::slug($data['name']);
        $counter = 1;
        while (CategoryEvent::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $slug.'-'.$counter;
            $counter++;
        }
        
        $data['slug'] = $slug;
        
        $update = $category->update($data);
        
        if($update) {
            return redirect()->route('admin.category-event.index')->with('success', 'Berhasil mengubah category');
        }
    }
}
