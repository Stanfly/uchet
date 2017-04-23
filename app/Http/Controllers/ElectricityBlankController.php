<?php

namespace App\Http\Controllers;

use App\ElectricityBlank;
use App\House;
use Illuminate\Http\Request;

use App\Http\Requests;

class ElectricityBlankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(House $house, Request $request){
        $elb = new ElectricityBlank();
        $elb->house_id = $house->id;
        $elb->tariff_single = $request->get('tariff_single');
        $elb->tariff_day = $request->get('tariff_day');
        $elb->tariff_night = $request->get('tariff_night');
        $elb->consumption = $request->get('consumption');
        $elb->sum_day = $request->get('sum_day');
        $elb->sum_night = $request->get('sum_night');
        $elb->charged = $request->get('charged');
        $elb->recalculation = $request->get('recalculation');
        $elb->total_charged = $request->get('total_charged');
        $elb->date = $request->get('date');
        $elb->save();
        return redirect(route('houses.show', $house->id));
    }
    public function index(House $house) {
        $elb = ElectricityBlank::where('house_id', $house->id)
            ->orderBy('date', 'desc')
            ->get();
        return view('pages.blanks.electricity.index',compact(['elb', 'house']));
    }
    public function show() {

    }
    public function delete(ElectricityBlank $elb) {
        $elb->delete();
    }
}
