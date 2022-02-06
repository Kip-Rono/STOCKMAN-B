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

        $purchase_orders = Stock::select(DB::raw("sum(amount_paid) as purchase_orders"))->get();
        $purchase_orders = (int)$purchase_orders[0]['purchase_orders'];

        $sales_number = Sales::select(DB::raw("sum(quantity) as sales"))->get();
        $sales_number = (int)$sales_number[0]['sales'];

        $sales = Sales::select(DB::raw("sum(amount_paid) as amount_in_sales"))->get();
        $sales = (int)$sales[0]['amount_in_sales'];
        $suppliers = Suppliers::count();
        $department = Department::count();
        $users = Users::count();

        $profit = (int)$sales - $purchase_orders;
        $names = ['purchase_orders', 'sales'];
        $prices = ['purchase_amount' => $purchase_orders,
            'sales' => $sales,
            'profit' => $profit,
            ];
        $data = [
            'prices' => $prices,
            'suppliers' => $suppliers,
            'department' => $department,
            'users' => $users,
            'names' => $names,
        ];
        return $data;
    }

    //daily report on certain date
    public function generateDailyReport($date){
//        return $date;
        $suppliers = Suppliers::count();
        $department = Department::count();
        $users = Users::count();

        $purchase_orders = Stock::select(DB::raw('sum(amount_paid) as purchase_amount'))
            ->where('date_entered', $date)
            ->get();
        $purchase_orders = (int)$purchase_orders[0]['purchase_amount'];

        $sales = Sales::select(DB::raw('sum(amount_paid) as sales_amount'))
            ->where('date_entered', $date)
            ->get();
        $sales = (int)$sales[0]['sales_amount'];

        $profit = $sales - $purchase_orders;

        return [
            'purchase_amount' => $purchase_orders,
            'sales' => $sales,
            'profit' => $profit,
            'suppliers' => $suppliers,
            'department' => $department,
            'users' => $users,
        ];
    }

}
