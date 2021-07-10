<?php

namespace App\Models; // App\Models\Genre

use CodeIgniter\Model;

class Genre extends Model{
    protected $table = 'genre';
    //protected $primaryKey = 'naziv primarnog kljuca ako nije id';
    protected $allowedFields = ['name'];
    protected $returnType = 'object';
}