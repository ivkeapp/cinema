<?php

namespace App\Models; 

use CodeIgniter\Model;

class MovieGenre extends Model{
    protected $table = 'movie_genre';
    //protected $primaryKey = 'naziv primarnog kljuca ako nije id';
    protected $allowedFields = ['movie_id', 'genre_id'];
    protected $returnType = 'object';
}