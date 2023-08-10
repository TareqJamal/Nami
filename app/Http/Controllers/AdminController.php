<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use function MongoDB\BSON\toJSON;

class AdminController extends Controller
{
    public function index()
    {
        return view('admins');
    }

    /**
     * @throws \Exception
     */
    public function admins_data()
    {
        if(\request()->ajax()){
            $data = Admin::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image',function(Admin $admin)
                {
                    return '<img src="' . asset('').$admin->image . '" width="100 height="80">';
                })
                ->addColumn('action', function(Admin $admin){
                    $btn ="<a id='btn_edit' class='edit btn btn-primary btn-sm' data-id=".$admin->id." >Edit</a>";
                    $btn = $btn."<a id='btn_delete' class='edit btn btn-danger btn-sm' data-id=".$admin->id." >Delete</a>";
                    return $btn;
                })
                ->rawColumns(['action','image'])
                ->toJSON();

        }
        return view('admins');
    }
}

