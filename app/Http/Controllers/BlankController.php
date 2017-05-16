<?php

namespace App\Http\Controllers;

use App\Blank;
use App\House;
use App\Prognosis;
use Illuminate\Http\Request;

use App\Http\Requests;




class BlankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(House $house, Request $request){
        $coldWaterBlank = new Blank();
        $coldWaterBlank->house_id = $house->id;
        $coldWaterBlank->norm = $request->get('norm');
        $coldWaterBlank->total_volume_of_MKD = $request->get('total_volume_of_MKD');
        $coldWaterBlank->tariff_with_NDS = $request->get('tariff_with_NDS');
        $coldWaterBlank->volume_of_services = $request->get('volume_of_services');
        $coldWaterBlank->charged = $request->get('charged');
        $coldWaterBlank->recalculation = $request->get('recalculation');
        $coldWaterBlank->total_charged = $request->get('total_charged');
        $coldWaterBlank->date = $request->get('date');
        $coldWaterBlank->save();
        return redirect(route('houses.show', $house->id));
    }
    public function index(House $house) {
        $cwbs = Blank::where('house_id', $house->id)
            ->orderBy('date', 'desc')
            ->get();
        $prognosis = Prognosis::get_prognosis_array($cwbs, 'desc');
        return view('pages.blanks.water.cold.index',compact(['cwbs', 'house', 'prognosis']));
    }
    public function chart(House $house) {
        $cwbs = Blank::where('house_id', $house->id)
            ->orderBy('date', 'asc')
            ->get();
        $ab = $this->trend($cwbs,"total_charged",4);
        return view('pages.blanks.water.cold.chart',compact(['cwbs', 'house', 'ab']));
    }
    public function show(House $house, Blank $cwb) {
        return view('pages.blanks.water.cold.show',compact(['cwb', 'house']));
    }
    public function delete(Task $task) {
        $task->delete();

        $tasks = Task::orderBy('created_at', 'asc')->get();
        return response()->json($tasks);
    }
}
