<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    public function citiesByCountry(int $id) {

        $countryInfo = Country::where('id', $id)->first();

        $cities = City::where('country_id', $id)
            ->select('id', 'name', 'local_food', 'photo', 'visited_at')
            ->get();

        return view('cities.allcities', compact('countryInfo', 'cities'));
    }


    public function deleteCities(int $id) {

        City::where('id', $id)->delete();

        return back();
    }

        public function addCities(int $id) {

        $countryInfo = Country::where('id', $id)->select('id', 'name')->first();

        return view('cities.addcity', compact('countryInfo'));
    }


    public function storeCity(Request $request) {

        //validar os dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'local_food' => 'max:50',
            'visited_at' => 'nullable|date',
            'photo' => 'image',
            'country_id' => 'required|exists:countries,id'
        ]);

        if($request->hasFile('photo')){
            //armazenar no storage e guarda o caminho numa var
            $photo = Storage::putFile('cityPhotos', $request->photo);
        }

        //depois de validados, inserir na bd
        City::insert([
            'name' => $request->name,
            'local_food' => $request->local_food,
            'visited_at' => $request->visited_at,
            'photo' => isset($photo) ? $photo : null,
            'country_id' => $request->country_id
        ]);

        return redirect()->route('cities.country', $request->country_id)->with('message', 'City added successfully!');
    }


    public function editCities(int $id) {

        $cityInfo = City::where('id', $id)
            ->select('id', 'name', 'local_food', 'photo', 'visited_at', 'country_id')
            ->first();

        return view('cities.editcity', compact('cityInfo'));
    }


    public function updateCity(Request $request) {

        $request->validate([
            'name' => 'required|max:50',
            'local_food' => 'max:50',
            'visited_at' => 'nullable|date',
            'photo' => 'image'
        ]);

        if($request->hasFile('photo')){
            //armazenar no storage e guarda o caminho numa var
            $photo = Storage::putFile('cityPhotos', $request->photo);
        }

        City::where('id', $request->id)->update([
            'name' => $request->name,
            'local_food' => $request->local_food,
            'visited_at' => $request->visited_at,
            'photo' => isset($photo) ? $photo : $request->current_photo
        ]);

        return redirect()->route('cities.country', $request->country_id)->with('message', 'City updated successfully!');
    }




}
