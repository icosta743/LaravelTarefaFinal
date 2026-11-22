<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function allTrash() {

        //países que estão na lixeira
        $countries = Country::onlyTrashed()
            ->select('id', 'name', 'photo', 'deleted_at')
            ->get();

        //cidades que estão na lixeira (só as de países que não foram apagados)
        $cities = City::onlyTrashed()
            ->join('countries', 'cities.country_id', '=', 'countries.id')
            ->whereNull('countries.deleted_at')
            ->select('cities.id', 'cities.name', 'cities.photo', 'cities.deleted_at', 'countries.name as country_name')
            ->get();

        return view('backoffice.trash', compact('countries', 'cities'));
    }

    public function restoreCountry(int $id) {

        //restaurar o país e as suas cidades
        Country::onlyTrashed()->where('id', $id)->restore();
        City::onlyTrashed()->where('country_id', $id)->restore();

        return redirect()->route('trash.all')->with('message', 'Country restored successfully!');
    }

    public function restoreCity(int $id) {

        City::onlyTrashed()->where('id', $id)->restore();

        return redirect()->route('trash.all')->with('message', 'City restored successfully!');
    }
}
