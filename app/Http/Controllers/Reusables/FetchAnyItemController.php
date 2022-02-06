<?php

namespace App\Http\Controllers\Reusables;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Sizes;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class FetchAnyItemController extends Controller
{
    //fetch all departments
    public function fetchDepartments(){
        $data = Department::all();
        return $data;
    }

    //fetch all suppliers
    public function fetchSuppliers(){
        $data = Suppliers::all();
        return $data;
    }

    //fetch all suppliers
    public function fetchSizes(){
        $data = Sizes::all();
        return $data;
    }
}
