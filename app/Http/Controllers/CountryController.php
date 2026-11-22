<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CountryController extends Controller
{
    public function allCountries() {

        $countries = $this->getAllCountries();

        return view('countries.allcountries', compact('countries'));
    }

    protected function getAllCountries() {
        $countries = Country::leftJoin('cities', 'countries.id', '=', 'cities.country_id')
            ->select(
                'countries.id',
                'countries.name',
                'countries.photo'
            )
            ->selectRaw('count(cities.id) as cities_count')
            ->groupBy('countries.id', 'countries.name', 'countries.photo')
            ->get();

        return $countries;
    }

        public function deleteCountries(int $id) {

        City::where('country_id', $id)->delete();
        Country::where('id', $id)->delete();

        return back();
    }

        public function addCountries() {

        return view('countries.addcountry');
    }


    public function storeCountry(Request $request) {

        //validar os dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'photo' => 'image'
        ]);

        if($request->hasFile('photo')){
            //armazenar no storage e guarda o caminho numa var
            $photo = Storage::putFile('countryPhotos', $request->photo);
        }

        //depois de validados, inserir na bd
        Country::insert([
            'name' => $request->name,
            'photo' => isset($photo) ? $photo : null
        ]);

        return redirect()->route('countries.all')->with('message', 'Country added successfully!');
    }

    
        public function editCountries(int $id) {

        $countryInfo = Country::where('id', $id)->select('id', 'name', 'photo')->first();

        return view('countries.editcountry', compact('countryInfo'));
    }


    public function updateCountry(Request $request) {

        $request->validate([
            'name' => 'required|max:50',
            'photo' => 'image'
        ]);

        if($request->hasFile('photo')){
            //armazenar no storage e guarda o caminho numa var
            $photo = Storage::putFile('countryPhotos', $request->photo);
        }

        Country::where('id', $request->id)->update([
            'name' => $request->name,
            'photo' => isset($photo) ? $photo : $request->current_photo
        ]);

        return redirect()->route('countries.all')->with('message', 'Country updated successfully!');
    }

}
