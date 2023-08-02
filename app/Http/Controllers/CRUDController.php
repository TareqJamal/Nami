<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CRUDController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'required|min:11',
            'image' => 'required',
        ]);
            $hash_password = bcrypt($request->password);
            $admin = new Admin();
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->password =  $hash_password;
            if($request->hasFile('image'))
            {
                $my_image = $request->file('image');
                $image_name = $my_image->getClientOriginalName();
                $location = $my_image->move('admin_images');
                $admin->image = $location;
            }
            $admin->save();
            // all good
            return response()->json(['success'=>true , 'message'=>'Done Addedd']);
    }

    public function delete(Request $request)
    {
        $admin_id = $request->id;
        Admin::find($admin_id)->delete();
        return response()->json();
    }

    public function edit(Request $request)
    {
        $admin_id = $request->id;
        $admin = Admin::find($admin_id);
        $decrpt_password = Hash::needsRehash($admin->password);
        return response()->json($admin);
    }

    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $admin_id = $request->id;
        $admin = Admin::findorfail($admin_id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->save();
        return response()->json();

    }
}
