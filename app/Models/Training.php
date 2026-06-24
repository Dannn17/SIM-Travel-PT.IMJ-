<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
    'name', 
    'domicile', 
    'guarantor', 
    //'track_record', 
    'source', 
    'age', 
    //'occupation', 
    'class_label'
];
}