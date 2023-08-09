<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CRUDAdminService
{
    public function store(Request $request )
    {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = Hash::make($request->password);
        if($request->hasFile('image'))
        {
            $my_image = $request->file('image');
            $image_name = $my_image->getClientOriginalName();
            $location = $my_image->move('admin_images');
            $admin->image = $location;
        }
        $admin->save();
    }

    public function edit(Request $request)
    {
        $admin = Admin::findorfail($request->id);
        $html = view('edit_admin',compact('admin'))->render();
        return $html;
    }


    public function update(Request $request)
    {
        $admin = Admin::findorfail($request->id);
        $admin->name = $request->name;
        $admin->email = $request->email ;
        $admin->phone = $request->phone ;
        $admin->save();
    }

    public function delete(Request $request)
    {
        Admin::destroy($request->id);
    }


}
