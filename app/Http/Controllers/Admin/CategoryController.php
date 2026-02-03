<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

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

        while (Category::where('slug', $slug)->exists()) {
            $slug = $slug.'-'.$counter;
            $counter++;
        }

        $data['slug'] = $slug;

        $category = Category::create($data);

        if ($category) {
            return redirect()->route('admin.category-event.index')->with('success', 'Berhasil menambahkan category');
        }
    }
    
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        
        if (! $category) {
            return abort(404);
        }
        
        return view('admin.category.edit', ['category' => $category]);
    }
    
    public function update(Request $request, $slug)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        
        $category = Category::where("slug", $slug)->first();
        
        $slug = Str::slug($data['name']);
        $counter = 1;
        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = $slug.'-'.$counter;
            $counter++;
        }
        
        $data['slug'] = $slug;
        
        $update = $category->update($data);
        
        if($update) {
            return redirect()->route('admin.category-event.index')->with('success', 'Berhasil mengubah category');
        }
    }
    
    public function delete($slug)
    {
        $category = Category::where("slug", $slug)->first(); 
        
        $delete = $category->delete();
        
        if($delete) {            
            return redirect()->route('admin.category-event.index')->with('success', 'Berhasil menghapus category');
        }
    }
}
