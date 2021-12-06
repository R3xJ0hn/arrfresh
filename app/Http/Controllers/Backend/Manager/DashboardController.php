<?php

namespace App\Http\Controllers\Backend\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Manager\OrderController;

class DashboardController extends Controller
{
    public function AdminDashboard(){
        $invoice = OrderController::GetAllOrders();
        return view('admin.index',compact('invoice'));
    }

}
