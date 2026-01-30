<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminCouponCreateRequest;
use App\Http\Requests\Admin\AdminCouponUpdateRequest;

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

    public function store(AdminCouponCreateRequest $request)
    {
        $data = $request->validated();
        
        $create = Coupon::create($data);
        
        if($create) {
            return redirect()->route("admin.coupon.index")->with("Berhasil menambahkan coupon");
        }
    }
    
    public function edit(Coupon $coupon) 
    {
        return view("admin.coupon.edit", [
            "coupon" => $coupon
        ]); 
    }

    public function update(AdminCouponUpdateRequest $request, Coupon $coupon) 
    {
        $data = $request->validated();

        $update = $coupon->update($data);
        
        if($update) {
            return redirect()->route("admin.coupon.index")->with("Berhasil mengedit coupon");
        }
    }
    
    public function delete(Coupon $coupon)
    {
        $delete = $coupon->delete();
        
        if($delete) {
            return redirect()->route("admin.coupon.index")->with("Berhasil menghapus coupon");
        }
    }
}
