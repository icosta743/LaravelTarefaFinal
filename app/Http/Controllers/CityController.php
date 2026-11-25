<?php

namespace App\Http\Controllers;

//models usados neste controller
use App\Models\City;
use App\Models\Country;

//para receber os dados dos formulários
use Illuminate\Http\Request;

//para guardar as fotos
use Illuminate\Support\Facades\Storage;

//controller criado com: php artisan make:controller CityController
class CityController extends Controller
{
    //cidades de um país (rota cities.country)
    //o $id é o id do país, que vem no endereço (/destinations/{id})
    public function citiesByCountry(int $id) {

        //vai buscar o país, para mostrar o nome no título
        $countryInfo = Country::where('id', $id)->first();

        //vai buscar só as cidades deste país
        $cities = City::where('country_id', $id)
            ->select('id', 'name', 'local_food', 'photo', 'visited_at')
            ->get();

        //envia o país e as cidades para a view cities/allcities.blade.php
        return view('cities.allcities', compact('countryInfo', 'cities'));
    }

    //apagar cidade (rota cities.delete)
    public function deleteCities(int $id) {

        City::where('id', $id)->delete();

        //volta à página anterior
        return back();
    }

    //página de adicionar cidade (rota cities.add)
    //recebe o id do país, para a cidade nova ficar ligada a ele
    public function addCities(int $id) {

        $countryInfo = Country::where('id', $id)->select('id', 'name')->first();

        return view('cities.addcity', compact('countryInfo'));
    }

    //guardar cidade nova (rota cities.store)
    public function storeCity(Request $request) {

        //validar os dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'local_food' => 'max:50',
            //a data pode ficar vazia, mas se for preenchida tem de ser uma data
            'visited_at' => 'nullable|date',
            'photo' => 'image',
            //o país tem de existir na tabela countries
            'country_id' => 'required|exists:countries,id'
        ]);

        //se foi escolhida uma foto
        if($request->hasFile('photo')){
            //armazenar no storage e guarda o caminho numa var
            $photo = Storage::putFile('cityPhotos', $request->photo);
        }

        //depois de validados, inserir na bd
        City::insert([
            'name' => $request->name,
            'local_food' => $request->local_food,
            'visited_at' => $request->visited_at,
            //se há foto guarda o caminho, senão fica vazio
            'photo' => isset($photo) ? $photo : null,
            //o id do país vem escondido no formulário
            'country_id' => $request->country_id
        ]);

        //volta às cidades deste país com uma mensagem de sucesso
        return redirect()->route('cities.country', $request->country_id)->with('message', 'City added successfully!');
    }

    //página de editar cidade (rota cities.edit)
    public function editCities(int $id) {

        //vai buscar a cidade para preencher o formulário
        $cityInfo = City::where('id', $id)
            ->select('id', 'name', 'local_food', 'photo', 'visited_at', 'country_id')
            ->first();

        return view('cities.editcity', compact('cityInfo'));
    }

    //atualizar cidade (rota cities.update)
    public function updateCity(Request $request) {

        //validar os dados no servidor
        $request->validate([
            'name' => 'required|max:50',
            'local_food' => 'max:50',
            'visited_at' => 'nullable|date',
            'photo' => 'image'
        ]);

        //se foi escolhida uma foto nova
        if($request->hasFile('photo')){
            //armazenar no storage e guarda o caminho numa var
            $photo = Storage::putFile('cityPhotos', $request->photo);
        }

        //atualiza a cidade com o id que veio escondido no formulário
        //se não houver foto nova, mantém a antiga (current_photo)
        City::where('id', $request->id)->update([
            'name' => $request->name,
            'local_food' => $request->local_food,
            'visited_at' => $request->visited_at,
            'photo' => isset($photo) ? $photo : $request->current_photo
        ]);

        //volta às cidades deste país com uma mensagem de sucesso
        return redirect()->route('cities.country', $request->country_id)->with('message', 'City updated successfully!');
    }
}
