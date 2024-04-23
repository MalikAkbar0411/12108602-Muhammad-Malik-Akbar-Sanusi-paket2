<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        return view('layouts.dashboard');
    }
    
    public function exportToExcel(){
        {
            return Excel::download(new SalesExport, 'sales.xlsx');
        }
    }
}


