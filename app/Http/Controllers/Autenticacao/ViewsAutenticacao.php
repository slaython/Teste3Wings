<?php

namespace App\Http\Controllers\Autenticacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewsAutenticacao extends Controller
{
    public function Autenticacao(){
        return view('autenticacao',[
            
        ]);
    }
}
