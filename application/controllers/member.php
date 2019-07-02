<?php 
defined('BASEPATH') or exit ('NO Direct Script Acces Allowed');

class Member extends CI_Controller{
	function __construct(){
		parent::__construct();
		//Cek LOGIN
		/*if($this->session->userdata('status') !="login"){
			$alert=$this->session->set_flashdata('alert','Anda Belum Login');redirect(base_url());
		}*/
	}
	function index(){
		$data['anggota'] = $this->M_perpus->get_data('anggota')->result();
		$data['buku'] = $this->M_perpus->get_data('buku')->result();
		$data['header'] = 'Katalog Buku';
		$this->load->view('daftarbuku', $data);
		}
	}