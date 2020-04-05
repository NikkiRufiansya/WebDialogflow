<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_trainingModel extends Model
{
    protected $table = "data_training";
    protected $fillable = ['intent','url_file','json', 'nama_file'];
}
