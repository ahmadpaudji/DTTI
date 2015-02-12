<?php

class Kpi extends CI_Controller{


	public function index(){
		$this->load->model('statistik');

		$pgw = $this->statistik->presensi();	

		var_dump($pgw);

	}
	

}