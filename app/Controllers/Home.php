<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('home');
	}

	public function lang($code){
		$this->session->set('lang', $code);
		return redirect()->to('/');
	}
}
