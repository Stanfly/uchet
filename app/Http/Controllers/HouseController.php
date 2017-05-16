<?php

namespace App\Http\Controllers;

use App\Blank;
use App\ElectricityBlank;
use App\HotWaterBlank;
use App\Prognosis;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\House;

use App\Http\Requests;

class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index () {
        $user = auth()->user();
        $houses = House::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.houses.index',compact('houses'));
    }
    public function create(Request $request){
        $user = auth()->user();
        $house = new House;
        $house->name = $request->get('house_name');
        $house->user_id = $user->id;
        $house->area = $request->get('house_area');
        $house->residents = $request->get('house_residents');
        $house->save();
        return redirect("/houses");
    }
    public function delete(House $house){
        $house->delete();
        return redirect("/houses");
    }
    public function show(House $house){
        $cwbs = Blank::where('house_id', $house->id)
            ->orderBy('date', 'desc')
            ->get();
        $hwbs = HotWaterBlank::where('house_id', $house->id)
            ->orderBy('date', 'desc')
            ->get();
        $elbs = ElectricityBlank::where('house_id', $house->id)
            ->orderBy('date', 'desc')
            ->get();
        $cwbs_prognosis = Prognosis::get_prognosis_array($cwbs, 'desc');
        $hwbs_prognosis = Prognosis::get_prognosis_array($hwbs, 'desc');
        $elbs_prognosis = Prognosis::get_prognosis_array($elbs, 'desc');
        return view('pages.houses.show',compact([
            'house',
            'cwbs',
            'hwbs',
            'elbs',
            'cwbs_prognosis',
            'hwbs_prognosis',
            'elbs_prognosis',
        ]));
    }
}
