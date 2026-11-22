<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    //página de todos os países
    public function allCountries() {

        $countries = $this->getAllCountries();

        return view('countries.allcountries', compact('countries'));
    }

    //países com o número de cidades (sem contar as que estão na lixeira)
    protected function getAllCountries() {
        $countries = Country::leftJoin('cities', function ($join) {
                $join->on('countries.id', '=', 'cities.country_id')
                    ->whereNull('cities.deleted_at');
            })
            ->select('countries.id', 'countries.name', 'countries.photo')
            ->selectRaw('count(cities.id) as cities_count')
            ->groupBy('countries.id', 'countries.name', 'countries.photo')
            ->get();

        return $countries;
    }

    //apagar país (primeiro as cidades, depois o país)
    public function deleteCountries(int $id) {

        City::where('country_id', $id)->delete();
        Country::where('id', $id)->delete();

        return back();
    }

    //página de adicionar país
    public function addCountries() {

        return view('countries.addcountry');
    }

    //guardar país novo
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

    //página de editar país
    public function editCountries(int $id) {

        $countryInfo = Country::where('id', $id)->select('id', 'name', 'photo')->first();

        return view('countries.editcountry', compact('countryInfo'));
    }

    //atualizar país
    public function updateCountry(Request $request) {

        //validar os dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'photo' => 'image'
        ]);

        if($request->hasFile('photo')){
            //armazenar no storage e guarda o caminho numa var
            $photo = Storage::putFile('countryPhotos', $request->photo);
        }

        //se não houver foto nova, mantém a antiga
        Country::where('id', $request->id)->update([
            'name' => $request->name,
            'photo' => isset($photo) ? $photo : $request->current_photo
        ]);

        return redirect()->route('countries.all')->with('message', 'Country updated successfully!');
    }
}
