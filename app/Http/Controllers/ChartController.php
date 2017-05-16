<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ChartController extends Controller
{
    public function chart(Request $request)
    {
        return view('components.ajax.chart_modal', compact('request'));
    }
}
