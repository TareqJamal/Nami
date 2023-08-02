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
                ->addColumn('action', function($row){
                    $btn ="<a id='btn_edit' class='edit btn btn-primary btn-sm' data-id=".$row->id." >Edit</a>";
                    $btn = $btn."<a id='btn_delete' class='edit btn btn-danger btn-sm' data-id=".$row->id." >Delete</a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJSON();

        }
        return view('admins');
    }
}

