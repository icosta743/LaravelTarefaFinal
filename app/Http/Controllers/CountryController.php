<?php

namespace App\Http\Controllers;

//models usados neste controller
use App\Models\Country;
use App\Models\City;

//para receber os dados dos formulários
use Illuminate\Http\Request;

//para guardar as fotos
use Illuminate\Support\Facades\Storage;

//controller criado com: php artisan make:controller CountryController
class CountryController extends Controller
{
    //página de todos os países (rota countries.all)
    public function allCountries() {

        //vai buscar os países à função de baixo
        $countries = $this->getAllCountries();

        //envia os países para a view countries/allcountries.blade.php
        return view('countries.allcountries', compact('countries'));
    }

    //países com o número de cidades (sem contar as que estão na lixeira)
    protected function getAllCountries() {
        //leftJoin: junta as cidades a cada país (os países sem cidades também aparecem)
        $countries = Country::leftJoin('cities', function ($join) {
                $join->on('countries.id', '=', 'cities.country_id')
                    //não conta as cidades apagadas (extra)
                    ->whereNull('cities.deleted_at');
            })
            ->select('countries.id', 'countries.name', 'countries.photo')
            //conta as cidades de cada país
            ->selectRaw('count(cities.id) as cities_count')
            //agrupa por país, para dar uma contagem por país
            ->groupBy('countries.id', 'countries.name', 'countries.photo')
            ->get();

        return $countries;
    }

    //apagar país (rota countries.delete)
    public function deleteCountries(int $id) {

        //primeiro as cidades do país, por causa da chave estrangeira
        City::where('country_id', $id)->delete();
        //depois o país
        Country::where('id', $id)->delete();

        //volta à página anterior
        return back();
    }

    //página de adicionar país (rota countries.add)
    public function addCountries() {

        return view('countries.addcountry');
    }

    //guardar país novo (rota countries.store)
    public function storeCountry(Request $request) {

        //validar os dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'photo' => 'image'
        ]);

        //se foi escolhida uma foto
        if($request->hasFile('photo')){
            //armazenar no storage e guarda o caminho numa var
            $photo = Storage::putFile('countryPhotos', $request->photo);
        }

        //depois de validados, inserir na bd
        Country::insert([
            'name' => $request->name,
            //se há foto guarda o caminho, senão fica vazio
            'photo' => isset($photo) ? $photo : null
        ]);

        //volta à lista com uma mensagem de sucesso
        return redirect()->route('countries.all')->with('message', 'Country added successfully!');
    }

    //página de editar país (rota countries.edit)
    public function editCountries(int $id) {

        //vai buscar o país para preencher o formulário
        $countryInfo = Country::where('id', $id)->select('id', 'name', 'photo')->first();

        return view('countries.editcountry', compact('countryInfo'));
    }

    //atualizar país (rota countries.update)
    public function updateCountry(Request $request) {

        //validar os dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'photo' => 'image'
        ]);

        //se foi escolhida uma foto nova
        if($request->hasFile('photo')){
            //armazenar no storage e guarda o caminho numa var
            $photo = Storage::putFile('countryPhotos', $request->photo);
        }

        //atualiza o país com o id que veio escondido no formulário
        //se não houver foto nova, mantém a antiga (current_photo)
        Country::where('id', $request->id)->update([
            'name' => $request->name,
            'photo' => isset($photo) ? $photo : $request->current_photo
        ]);

        //volta à lista com uma mensagem de sucesso
        return redirect()->route('countries.all')->with('message', 'Country updated successfully!');
    }
}
