<?php

namespace App\Http\Controllers;

use App\Models\transaction_model;
use Illuminate\Http\Request;

class Dashboard extends Controller
{

    public function Dashboard()
    {
        return view('Dashboard.index');
    }
    
}
