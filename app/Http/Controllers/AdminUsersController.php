<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AdminUsersController extends Controller{

    public function Users(Request $req, $id = null){

        if ( $req->isMethod('post') ) {

             if (!$req->input('id')) {
            
            }else{
        
                $User = User::find($req->input('id'));
                $User->name = $req->input('name');
                $User->numero_celular = $req->input('celular');
                $User->f_nacimiento = $req->input('f_nacimiento');            
                $User->cod_ciudad = $req->input('ciudad');   
                $User->save();
                
                return redirect()->route('home');

            }
        
        }else if($req->isMethod('get') && $id != null) {

            $User = User::where('id', $id)->get();
            
            return view('Users.EditUser', [
                'User' => $User               
            ]);
        
        }
    }

    public function DeleteUser(Request $req, $id = null){  

        $User = User::find($id);
        $User->delete();
        
        return redirect()->route('home');
    
    } 

    public function Buscar(Request $req, $id = null){

        $User = DB::table('users')
        ->select('name', 'email', 'cedula', 'numero_celular', 'rol', 'f_nacimiento', 'cod_ciudad')
        ->where(DB::raw("CONCAT(name,' ',cedula,' ',email )"), 'LIKE', '%' . $id . '%')
        ->paginate(10);
        
        return $User;

    }
    
}
