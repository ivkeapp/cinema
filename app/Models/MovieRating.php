<?php

namespace App\Models; 

use CodeIgniter\Model;

class MovieRating extends Model{
    protected $table = 'movie_rating';
    //protected $primaryKey = 'naziv primarnog kljuca ako nije id';
    protected $allowedFields = ['movie_id', 'user_id', 'rating'];
    protected $returnType = 'object';

    public function getRatingForUser($movie_id, $user_id){
        $myRating = $this->builder()
            ->where('movie_id', $movie_id)
            ->where('user_id', $user_id)
            ->get()->getResult();
        if(count($myRating) > 0){
            return $myRating[0];
        }else{
            return null;
        }
    }

    public function getRatingValueForUser($movie_id, $user_id){
        $myRating = $this->getRatingForUser($movie_id, $user_id);
        if($myRating != null){
            return $myRating->rating;
        }else{
            return 0;
        }
    }

    public function getMovieRating($movie_id){
        return $this->builder()
            ->select("round(coalesce(avg(rating),0)) as rating")
            ->where('movie_id', $movie_id)
            ->get()->getResult()[0]->rating;
    }
}