<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmacionController extends Controller
{
    //

    public function confirmation($id)
    {
        
        return view('confirmacion', ['compra_id' => $id]);
    }
}
