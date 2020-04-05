<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingData extends Controller
{
    public function index($id)
    {
        $data['id_pertanyaan'] = $id;
        return view('trainingData',$data);
    }
}
