<?php
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); // controller

class Latihan extends CI_Controller {

	public function index()
	{
		public function __construct()		//conts
		{
			parent::__construct();
			$this->load->model('M_perpus'); 	//loadm
			$this->load->view('buku', $data);

		}
		
	}

}

/* End of file latihan.php */
/* Location: ./application/views/latihan.php */