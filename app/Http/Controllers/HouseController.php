<?php

namespace App\Http\Controllers;

use App\Blank;
use App\ElectricityBlank;
use App\HotWaterBlank;
use App\Prognosis;
use App\Service;
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
        $services = Service::where('house_id', $house->id)->orWhere('house_id', null)
            ->orderBy('id', 'asc')
            ->get();
        foreach ($services as $service) {
            $service['blanks'] = Blank::where('service_id', $service->id)
                ->where('house_id', $house->id)
                ->orderBy('date', 'desc')
                ->get();
            $service['prognosis'] = Prognosis::get_prognosis_array($service['blanks'], 'desc');
        }

        return view('pages.houses.show',compact(['house', 'services']));
    }
}
