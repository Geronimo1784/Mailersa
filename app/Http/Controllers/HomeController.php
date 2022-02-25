<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Emails;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailUsers;
use App\Jobs\SendEMail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $Users = User::where('rol', 'USUARIO')->paginate(5);
        return view('home', [
            'Users' => $Users
        ]);
    }

    public function SendMailLog(Request $req){

        if ( $req->isMethod('post') ) {

            $Mail = new Emails; 
            $Mail->id_usuario = $req->input('id_user');
            $Mail->asunto = $req->input('asunto');            
            $Mail->destinatario = $req->input('destino');
            $Mail->mensage = $req->input('body');
            $Mail->estado = 'no enviado';
            $Mail->save();

        }

        $SendEMail = SendEMail::dispatch();
        return redirect()->route('home');
        
    }

    public function Mailusuarios(Request $req, $id = null){

        $Mails = Emails::where('id_usuario', $id)->get();
        return $Mails;

    }

    public function Emailsall(Request $req, $id = null){

        $Mails = Emails::All();
        return $Mails;

    }    
}
