<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'pageTitle' => 'Dashboard'
		];
		return view('baseview', $data);
	}

	//--------------------------------------------------------------------

}
