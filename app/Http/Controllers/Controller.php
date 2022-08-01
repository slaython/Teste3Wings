<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $Helpers;

    public function __construct(){
    	//HELPER GERAL
    	$this->Helpers = new Helpers();
    }
}
