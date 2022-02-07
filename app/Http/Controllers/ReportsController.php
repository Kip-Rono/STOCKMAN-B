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

        $clothes_purchase_orders = Stock::select(DB::raw("sum(amount_paid) as purchase_orders"))
            ->where('department', 1)
            ->get();
        $clothes_purchase_orders = (int)$clothes_purchase_orders[0]['purchase_orders'];

        $food_purchase_orders = Stock::select(DB::raw("sum(amount_paid) as purchase_orders"))
            ->where('department', 2)
            ->get();
        $food_purchase_orders = (int)$food_purchase_orders[0]['purchase_orders'];

        $food_sales = Sales::select(DB::raw("sum(amount_paid) as amount_in_sales"))
            ->where('department', 2)
            ->get();
        $food_sales = (int)$food_sales[0]['amount_in_sales'];


        $clothes_sales = Sales::select(DB::raw("sum(amount_paid) as amount_in_sales"))
            ->where('department', 1)
            ->get();
        $clothes_sales = (int)$clothes_sales[0]['amount_in_sales'];

        $profit = (int)$sales - $purchase_orders;
        $clothes_profit = (int)$clothes_sales - $clothes_purchase_orders;
        $food_profit = (int)$food_sales - $food_purchase_orders;

        $names = ['purchase_orders', 'sales'];
        $prices = [
            'purchase_amount' => $purchase_orders,
            'sales' => $sales,
            'food_purchase_amount' => $food_purchase_orders,
            'clothes_purchase_amount' => $clothes_purchase_orders,
            'food_sales' => $food_sales,
            'clothes_sales' => $clothes_sales,
            'profit' => $profit,
            ];
        return [
            'purchase_amount' => $purchase_orders,
            'sales' => $sales,
            'profit' => $profit,
            'food_purchase_amount' => $food_purchase_orders,
            'food_sales' => $food_sales,
            'clothes_purchase_amount' => $clothes_purchase_orders,
            'clothes_sales' => $clothes_sales,
            'clothes_profit' => $clothes_profit,
            'food_profit' => $food_profit,
            'suppliers' => $suppliers,
            'department' => $department,
            'users' => $users,
            'names' => $names,
        ];
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
