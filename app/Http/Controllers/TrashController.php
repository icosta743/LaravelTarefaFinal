<?php

namespace App\Http\Controllers;

//models usados neste controller
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;

//controller criado com: php artisan make:controller TrashController
//extra: lixeira com soft deletes (não foi dado em aula)
class TrashController extends Controller
{
    //página da lixeira (rota get - trash.all)
    public function allTrash() {

        //países que estão na lixeira
        //onlyTrashed: vai buscar só os que têm o deleted_at preenchido (apagados)
        $countries = Country::onlyTrashed()
            ->select('id', 'name', 'photo', 'deleted_at')
            ->get();

        //cidades que estão na lixeira
        $cities = City::onlyTrashed()
            //join com a tabela countries para ir buscar o nome do país de cada cidade
            //(a tabela cities só tem o country_id, não tem o nome do país)
            ->join('countries', 'cities.country_id', '=', 'countries.id')
            //só mostra as cidades de países que não estão na lixeira
            //(as cidades de um país apagado voltam junto com o país)
            ->whereNull('countries.deleted_at')
            //cities.name e countries.name têm o mesmo nome de coluna,
            //por isso o nome do país passa a chamar-se country_name
            ->select('cities.id', 'cities.name', 'cities.photo', 'cities.deleted_at', 'countries.name as country_name')
            ->get();

        //envia os países e as cidades apagados para a view backoffice/trash.blade.php
        return view('backoffice.trash', compact('countries', 'cities'));
    }

    //restaurar o país e as suas cidades (rota get - countries.restore)
    public function restoreCountry(int $id) {

        //restore: volta a pôr o deleted_at vazio, e o país reaparece no site
        Country::onlyTrashed()->where('id', $id)->restore();
        //restaura também as cidades desse país, que foram apagadas com ele
        City::onlyTrashed()->where('country_id', $id)->restore();

        //volta à lixeira com uma mensagem de sucesso
        return redirect()->route('trash.all')->with('message', 'Country restored successfully!');
    }

    //restaurar uma cidade (rota get - cities.restore)
    public function restoreCity(int $id) {

        //restaura só esta cidade
        City::onlyTrashed()->where('id', $id)->restore();

        //volta à lixeira com uma mensagem de sucesso
        return redirect()->route('trash.all')->with('message', 'City restored successfully!');
    }
}
