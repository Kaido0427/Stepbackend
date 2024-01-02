<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table='language';
    protected $fillable=[
        'name','direction','image','json_file','status'
    ];
    public $timestamps= false;
}
