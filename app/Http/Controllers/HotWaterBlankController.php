<?php

namespace App\Http\Controllers;

use App\HotWaterBlank;
use App\House;
use Illuminate\Http\Request;

use App\Http\Requests;

class HotWaterBlankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(House $house, Request $request){
        $hotWaterBlank = new HotWaterBlank();
        $hotWaterBlank->house_id = $house->id;
        $hotWaterBlank->norm = $request->get('norm');
        $hotWaterBlank->total_volume_of_MKD = $request->get('total_volume_of_MKD');
        $hotWaterBlank->tariff_with_NDS = $request->get('tariff_with_NDS');
        $hotWaterBlank->volume_of_services = $request->get('volume_of_services');
        $hotWaterBlank->charged = $request->get('charged');
        $hotWaterBlank->recalculation = $request->get('recalculation');
        $hotWaterBlank->total_charged = $request->get('total_charged');
        $hotWaterBlank->date = $request->get('date');
        $hotWaterBlank->save();
        return redirect(route('houses.show', $house->id));
    }
    public function index(House $house) {
        $hwbs = HotWaterBlank::where('house_id', $house->id)
            ->orderBy('date', 'desc')
            ->get();
        return view('pages.blanks.water.hot.index',compact(['hwbs', 'house']));
    }
    public function show() {

    }
    public function delete(HotWaterBlank $hwb) {
        $hwb->delete();
    }
}
