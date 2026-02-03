<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();

        return view("admin.coupon.index", [
            "coupons" => $coupons
        ]);
    }
    
    public function create()
    {
        return view("admin.coupon.create");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "code" => "required|unique:coupons,code",
            "discount_type" => "required",
            "discount_value" => "required",
            "is_active" => "required",
            "open_at" => "required",
            "closed_at" => "required",
        ]);
        
        $create = Coupon::create($data);
        
        if($create) {
            return redirect()->route("admin.coupon.index")->with("success", "Berhasil menambahkan coupon");
        }
    }
    
    public function edit(Coupon $coupon) 
    {
        return view("admin.coupon.edit", [
            "coupon" => $coupon
        ]); 
    }

    public function update(Request $request, Coupon $coupon) 
    {
        $data = $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            // 'code' => ['required', Rule::unique("coupons", "code")->ignore($coupon)],
            'discount_type' => 'required',
            'discount_value' => 'required',
            'is_active' => 'required',
            'open_at' => 'required',
            'closed_at' => 'required',
        ]);
        
        // 'code' => [
        //     'required',
        //     Rule::unique('coupons', 'code')->ignore(
        //         $this->route('admin.coupon.update')
        //     ),
        // ],
        
        $update = $coupon->update($data);
        
        if($update) {
            return redirect()->route("admin.coupon.index")->with("success", "Berhasil mengedit coupon");
        }
    }
    
    public function delete(Coupon $coupon)
    {
        $delete = $coupon->delete();
        
        if($delete) {
            return redirect()->route("admin.coupon.index")->with("success", "Berhasil menghapus coupon");
        }
    }
}
