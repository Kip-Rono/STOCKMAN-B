<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Sales;
use App\Models\Stock;
use App\Models\Suppliers;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    //
    public function fetchReportsData()
    {
        $purchase_amount = Stock::sum('amount_paid');
        $sales = Sales::sum('amount_paid');
        $profit = $sales - $purchase_amount;
        $clothes_purchase_amount = Stock::where('department', 1)->sum('amount_paid');
        $clothes_sales = Sales::where('department', 1)->sum('amount_paid');
        $clothes_profit = $clothes_sales - $clothes_purchase_amount;
        $food_purchase_amount = Stock::where('department', 2)->sum('amount_paid');
        $food_sales = Sales::where('department', 2)->sum('amount_paid');
        $food_profit = $food_sales - $food_purchase_amount;
        $suppliers = Suppliers::count();
        $department = Department::count();
        $users = User::count();



        return [
            'purchase_amount' => $purchase_amount,
            'sales' => $sales,
            'profit' => $profit,
            'clothes_purchase_amount' => $clothes_purchase_amount,
            'clothes_sales' => $clothes_sales,
            'clothes_profit' => $clothes_profit,
            'food_purchase_amount' => $food_purchase_amount,
            'food_sales' => $food_sales,
            'food_profit' => $food_profit,
            'suppliers' => $suppliers,
            'department' => $department,
            'users' => $users,
        ];
    }

    //daily report
    public function generateDailyReport($date)
    {

        $purchase_amount = Stock::where('date_entered', '=', $date)->sum('amount_paid');
        $sales = Sales::where('date_entered', '=', $date)->sum('amount_paid');
        $profit = $sales - $purchase_amount;
        $clothes_purchase_amount = Stock::where('date_entered', '=', $date)->where('department', 1)->sum('amount_paid');
        $clothes_sales = Sales::where('date_entered', '=', $date)->where('department', 1)->sum('amount_paid');
        $clothes_profit = $clothes_sales - $clothes_purchase_amount;
        $food_purchase_amount = Stock::where('date_entered', '=', $date)->where('department', 2)->sum('amount_paid');
        $food_sales = Sales::where('date_entered', '=', $date)->where('department', 2)->sum('amount_paid');
        $food_profit = $food_sales - $food_purchase_amount;
        $suppliers = Suppliers::count();
        $department = Department::count();
        $users = User::count();

        return [
            'purchase_amount' => $purchase_amount,
            'sales' => $sales,
            'profit' => $profit,
            'clothes_purchase_amount' => $clothes_purchase_amount,
            'clothes_sales' => $clothes_sales,
            'clothes_profit' => $clothes_profit,
            'food_purchase_amount' => $food_purchase_amount,
            'food_sales' => $food_sales,
            'food_profit' => $food_profit,
            'suppliers' => $suppliers,
            'department' => $department,
            'users' => $users,
        ];
    }

}
