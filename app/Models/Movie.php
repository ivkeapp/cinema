<?php

namespace App\Models;

use CodeIgniter\Model;

class Movie extends Model{
    protected $table = 'movie';
    //protected $primaryKey = 'naziv primarnog kljuca ako nije id';
    protected $allowedFields = ['title', 'start_date', 'short_description', 'description', 'poster', 'poster_vertical'];
    protected $returnType = 'object';


    public function getMovies($page=1, $perPage=1, $orderBy='id', $order='asc'){
        return $this->builder()
            ->select("id, title, start_date, short_description, poster, 
                        poster_vertical")
            ->select("(select GROUP_CONCAT(name SEPARATOR ', ') as genre
                        from genre g 
                        inner join movie_genre mg on mg.genre_id = g.id
                        where mg.movie_id = movie.id) as genres")
            ->select("(SELECT round(COALESCE(avg(rating),0))
                        from movie_rating mr
                        where mr.movie_id = movie.id) as rating")
            ->orderBy($orderBy, $order)
            ->limit($perPage, ($page -1) * $perPage)
            ->get();
    }

    public function getMovie($id){
        return $this->builder()
            ->select("id, title, start_date, short_description, poster, 
                        poster_vertical, description")
            ->select("(select GROUP_CONCAT(name SEPARATOR ', ') as genre
                        from genre g 
                        inner join movie_genre mg on mg.genre_id = g.id
                        where mg.movie_id = movie.id) as genres")
            ->select("(SELECT round(COALESCE(avg(rating),0))
                        from movie_rating mr
                        where mr.movie_id = movie.id) as rating")
            ->where('id', $id)
            ->get();
    }
}