<?php

namespace App\Http\Controllers\Reusables;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class FetchAnyItemController extends Controller
{
    //fetch all departments
    public function fetchDepartments(){
        $data = Department::all();
        return $data;
    }
}
