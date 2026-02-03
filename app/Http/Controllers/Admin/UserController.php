<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view("admin.user.index", [
            "users" => $users
        ]);
    }

    public function create()
    {
        return view("admin.user.create");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email",
            "password" => "required|confirmed|min:8",
            "role" => "required",
            'avatar' => 'required|image|mimes:jpg,jepg,png,jfif,webp,gif|max:2048',
        ]);
        
        $path = "/images/avatar/";
        $file = $data["avatar"];
        $filename = time() ."-". $file->getClientOriginalName();
        
        $file->storeAs($path, $filename);
        $data["avatar"] = $filename;
        
        $create = User::create($data);
        
        if ($create) {
            return redirect()->route("admin.user.index")->with("success", "Berhasil menambahkan user");
        }
    }
    
    public function edit(User $user)
    {
        return view("admin.user.edit", [
            "user" => $user
        ]);
    }
    
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email," . $user->id,
            "password" => "nullable|confirmed|min:8",
            "role" => "required",
            'avatar' => 'nullable|image|mimes:jpg,jepg,png,jfif,webp,gif|max:2048',
        ]);
        
        if (empty($request->password)) {
            unset($data["password"]);
        }
        
        if($request->file("avatar")) {
            $path = "/images/avatar/";
            $file = $data["avatar"];
            $filename = time() ."-". $file->getClientOriginalName();
            
            Storage::delete($path . $user->avatar);
            
            $file->storeAs($path, $filename);
            $data["avatar"] = $filename;
        }

        $update = $user->update($data);

        if ($update) {
            return redirect()->route("admin.user.index")->with("success", "Berhasil mengedit user");
        }
    }

    public function delete(User $user)
    {
        $delete = $user->delete();

        if ($delete) {
            return redirect()->route("admin.user.index")->with("success", "Berhasil menghapus user");
        }
    }
}
