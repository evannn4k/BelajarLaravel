<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function profil()
    {
        return view("user.profil");
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email," . $id,
            "password" => "nullable|confirmed|min:8",
            'avatar' => 'nullable|image|mimes:jpg,jepg,png,jfif,webp,gif|max:2048',
        ]);

        $user = User::findOrFail($id);
        
        if($request->file("avatar")) {
            $path = "/images/avatar/";
            $file = $data["avatar"];
            $filename = time() ."-". $file->getClientOriginalName();
            
            Storage::delete($path . $user->avatar);
            
            $file->storeAs($path, $filename);
            $data["avatar"] = $filename;
        }

        if (empty($request->password)) {
            unset($data["password"]);
        }
        
        $update = $user->update($data);

        if ($update) {
            return redirect()->route("profil.index")->with("success", "Berhasil mengedit user");
        }
    }
}