<?php

namespace App\Http\Controllers;

use Illuminate\Cache\Repository;
use Illuminate\Http\Request;
use App\House;

use App\Http\Requests;

class HouseController extends Controller
{
    private $houses;

    public function __construct(Repository $houses)
    {
        $this->middleware('auth');
        $this->houses = $houses;
    }
    public function index () {
        $user = auth()->user();
        try {
            $houses = $this->houses->getAll($user);
        } catch (InvalidArgumentException $argumentException) {
            logger(__METHOD__ . PHP_EOL . $argumentException->getMessage());
            return redirect()->to('home');
        } catch (ShopException $shopException) {
            return redirect()->to('home');
        }
        $houses = House::select('id') //orderBy('created_at', 'desc')->get();
        return view('pages.houses.index',compact('houses'));
    }
    public function create(Request $request){
        $house = new House;
        $house->name = $request->get('house_name');
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
        return view('pages.houses.show',compact('house'));
    }
}
