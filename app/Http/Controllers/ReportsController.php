<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Sales;
use App\Models\Stock;
use App\Models\Suppliers;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    //
    public function fetchReportsData()
    {

        $purchase_orders = Stock::select(DB::raw("sum(quantity) as purchase_orders"))->get();
        $sales = Sales::select(DB::raw("sum(quantity) as sales"))->get();
        $sales_amount = Sales::select(DB::raw("sum(amount_paid) as amount_in_sales"))->get();
        $suppliers = Suppliers::count();
        $department = Department::count();
        $users = Users::count();

        $data = [
            'purchase_orders' => (int)$purchase_orders[0]['purchase_orders'],
            'sales' => (int)$sales[0]['sales'],
            'sales_amount' => (int)$sales_amount[0]['amount_in_sales'],
            'suppliers' => $suppliers,
            'department' => $department,
            'users' => $users,
        ];
        return $data;
    }
}
