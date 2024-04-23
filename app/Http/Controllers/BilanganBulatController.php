<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BilanganBulatController extends Controller
{
    public function index()
    {
        return view('bilangan-bulat.index');
    }
}
