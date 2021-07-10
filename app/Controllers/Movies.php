<?php

namespace App\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\MovieRating;
use CodeIgniter\Events\Events;

class Movies extends BaseController
{
	protected $model;

	public function __construct()
	{
		$this->model = new Movie();
	}

	public function index()
	{
		return view('movies/index');
	}

	public function search(){
		$page = $this->request->getGet('page') ?? 1;
		$perPage = $this->request->getGet('perPage') ?? 1;
		$orderBy = $this->request->getGet('orderBy') ?? 'id';
		$order = $this->request->getGet('order') ?? 'asc';

		$movies = $this->model->getMovies($page, $perPage, $orderBy, $order);
		$data['movies'] = $movies;
		return view('movies/index', $data);
	}

	public function rate(){
		$throttler = \Config\Services::throttler();
		if($throttler->check('rating', 2, MINUTE) === false){
			return $this->response->setStatusCode(403);
		}

		if(logged_in() && $this->validate([
			'movie_id' => 'required',
			'rating' => 'required',
		])){
			$movie_id = $this->request->getVar('movie_id');
			$rating = $this->request->getVar('rating');

			log_message('error', 'Rating movie id:'. $movie_id);

			$modelMR = new MovieRating();
			$record = $modelMR->getRatingForUser($movie_id, user_id());

			$new_record = [
				'movie_id' => $movie_id,
				'user_id' => user_id(),
				'rating' => $rating,
			];

			if($record != null){
				$new_record['id'] = $record->id;
				$modelMR->update($record->id, $new_record);
			}else{
				$modelMR->insert($new_record);
			}
			
			/*
			$email = \Config\Services::email();

			$email->setTo(user()->email);
			$email->setSubject('Movie rating');
			$email->setMessage('You have rated the movie ID: '. $movie_id. '.<br>Your rating is: '. $rating);
			$email->send();*/

			Events::trigger('rated', $movie_id, user()->username, $rating);

			echo $modelMR->getMovieRating($movie_id);
		}
	}

	public function view($id)
	{
		log_message('error', 'Viewing movie id:'. $id);
		$movies = $this->model->getMovie($id);
		$data['movie'] = $movies->getResult()[0];
		return view('movies/view', $data);
	}

	public function create(){
		$genreModel = new Genre();
		$data['genres'] = $genreModel->findAll();
		return view('movies/create', $data);
	}

	public function attemptCreate(){
		if($this->validate([
			'title' => 'required',
			'date' => 'required',
			'poster' => [
				'uploaded[poster]',
				'mime_in[poster,image/jpg,image/jpeg]'
			]
		])){
			$movie = [
				'title' => $this->request->getPost('title'),
				'start_date' => $this->request->getPost('date'),
				'short_description' => $this->request->getPost('short_description'),
				'description' => $this->request->getPost('description'),
			];

			$movieID = $this->model->insert($movie, true);

			helper('date');
			$posterName = $movieID . "_". now(). ".jpg"; // 7_6415351681.jpg   update => 7_88468468464.jpg
			$poster = $this->request->getFile('poster');
			$poster->move('../public/assets/img/movie', $posterName, true);

			$posterVerticalName = $movieID . "_vertical.jpg";
			$posterVertical = $this->request->getFile('poster_vertical');
			$posterVertical->move('../public/assets/img/movie', $posterVerticalName, true);

			$movie['id'] = $movieID;
			$movie['poster'] = $posterName;
			$movie['poster_vertical'] = $posterVerticalName;
			$this->model->update($movieID, $movie);

			$movieGenreModel = new MovieGenre();
			foreach($this->request->getPost('genres') as $g){
				$record = [
					'movie_id' => $movieID,
					'genre_id' => $g,
				];
				$movieGenreModel->insert($record);
			}

			return redirect()->to('movies/create')->with('message', 'Success');
		}else{
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}
}
