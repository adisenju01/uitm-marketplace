<?php

namespace App\Http\Controllers\Backend;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SellerServicesDataTable;
use App\DataTables\SellerPendingServicesDataTable;

class SellerServiceController extends Controller
{
    public function index(SellerServicesDataTable $dataTable)
    {
        return $dataTable->render('admin.service.seller-service.index');
    }

    public function pendingServices(SellerPendingServicesDataTable $dataTable)
    {
        return $dataTable->render('admin.service.seller-pending-service.index');
    }

    public function changeApproveStatusService(Request $request)
    {
        $service = Service::findOrFail($request->id);
        $service->is_approved = $request->value;
        $service->save();

        return response(['message' => 'Service Approve Status Has Been Changed']);
    }
}
