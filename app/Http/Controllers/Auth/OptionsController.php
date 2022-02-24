<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estados;
use App\Models\Ciudades;

class OptionsController extends Controller{

    
    public function Buscar_Estados(Request $req, $id = null){

        $Estados = Estados::where('pais_id', $id)->get();
        return $Estados;

    }

    public function Buscar_Ciudades(Request $req, $id = null){

        $Estados = Ciudades::where('departamento_id', $id)->get();
        return $Estados;

    }
    


}
