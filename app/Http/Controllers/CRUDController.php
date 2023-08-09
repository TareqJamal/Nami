<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use Illuminate\Http\Request;
use App\Services\CRUDAdminService;

class CRUDController extends Controller
{
    public function store(StoreAdminRequest $request , CRUDAdminService $adminService)
    {
        $adminService->store($request);
        return response()->json(['success'=>true , 'message'=>'Done Addedd']);
    }

    public function delete(Request $request , CRUDAdminService $adminService)
    {
        $adminService->delete($request);
        return response()->json();
    }

    public function edit(Request $request , CRUDAdminService $adminService)
    {
       $html = $adminService->edit($request);
       return response()->json(['html' => $html]);
    }

    public function update(Request $request , CRUDAdminService $adminService): \Illuminate\Http\JsonResponse
    {
        $adminService->update($request);
        return response()->json();

    }
}
