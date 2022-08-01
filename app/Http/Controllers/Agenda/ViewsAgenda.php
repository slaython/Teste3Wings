<?php

namespace App\Http\Controllers\Agenda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ViewsAgenda extends Controller
{
    public function Agenda(){
        if(Session::has('3WINGS')){
            return view('agenda',[
                'COMPROMISSOS' => $this->Helpers->Compromissos(),
            ]);
        }
        return view('autenticacao');
    }
}
