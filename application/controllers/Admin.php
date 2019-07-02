<?php
defined('BASEPATH') or exit ('NO Direct Script Access Allowed');

class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		// cek login
		if($this->session->userdata('status') != "login"){
			$alert=$this->session->set_flashdata('alert', 'Anda belum Login');
			redirect(base_url());
		}
	}

	function index(){
		$data['peminjaman'] = $this->db->query("select * from transaksi order by id_pinjam desc limit 10")->result();
		$data['anggota'] = $this->db->query("select * from anggota order by id_anggota desc limit 10")->result();
		$data['buku'] = $this->db->query("select * from buku order by id_buku desc limit 10")->result();

		$this->load->view('admin/header');
		$this->load->view('admin/index',$data);
		$this->load->view('admin/footer');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'welcome?pesan=logout');
	}

	function ganti_password(){
		$this->load->view('admin/header');
		$this->load->view('admin/ganti_password');
		$this->load->view('admin/footer');
	}

	function ganti_password_act(){
		$pass_baru = $this->input->post('pass_baru');
		$ulang_pass = $this->input->post('ulang_pass');

		$this->form_validation->set_rules('pass_baru','Password Baru','required|matches[ulang_pass]');
		$this->form_validation->set_rules('ulang_pass','Ulangi Password Baru','required');
		if($this->form_validation->run() != false){
			$data = array('password' => md5($pass_baru));
			$w = array('id_admin' => $this->session->userdata('id'));
			$this->M_perpus->update_data($w,$data,'admin');
			redirect(base_url().'admin/ganti_password?pesan=berhasil');
		}else{
			$this->load->view('admin/header');
			$this->load->view('admin/ganti_password');
			$this->load->view('admin/footer');
		}
	}

	function buku(){
		$data['buku'] = $this->M_perpus->get_data('buku')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/buku',$data);
		$this->load->view('admin/footer');
	}

	function tambah_buku(){
		//memuat data kategori untuk ditampilkan di select form
		$data['kategori'] =$this->M_perpus->get_data('kategori')->result();

		$this->load->view('admin/header');
		$this->load->view('admin/tambah_buku',$data);
		$this->load->view('admin/footer');
	}

	function tambah_buku_act(){
		$tgl_input = date('Y-m-d');
		$id_kategori = $this->input->post('id_kategori');
		$judul = $this->input->post('judul_buku');
		$pengarang = $this->input->post('pengarang');
		$penerbit = $this->input->post('penerbit');
		$thn_terbit = $this->input->post('thn_terbit');
		$isbn = $this->input->post('isbn');
		$jumlah_buku = $this->input->post('jumlah_buku');
		$lokasi = $this->input->post('lokasi');
		$status_buku= $this->input->post('status_buku');
		$this->form_validation->set_rules('id_kategori','Kategori','required');
		$this->form_validation->set_rules('judul_buku','Judul Buku','required');
		$this->form_validation->set_rules('status_buku','Status Buku','required');
		if($this->form_validation->run() != FALSE){
			//configurasi upload gambar
			$config['upload_path'] = './assets/upload/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['file_name'] = 'gambar'.'time';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('gambar')){
				$gambar=$this->upload->data();

				$data = array(
					'id_kategori' =>$id_kategori,
					'judul_buku' => $judul_buku,
					'pengarang' => $pengarang,
					'penerbit' => $penerbit,
					'thn_terbit' => $thn_terbit,
					'isbn' => $isbn,
					'jumlah_buku' => $jumlah_buku,
					'lokasi' => $lokasi,
					'gambar' => $gambar['file_name'],
					'tgl_input' => $tgl_input,
					'status_buku' => $status_buku
				);

				$this->M_perpus->insert_data($data,'buku');
				redirect(base_url().'admin/buku');
			}else{
				if($this->session->set_flashdata('alert', 'Anda Belum Memilih Foto'));
			}
		}else{
			$data['kategori'] = $this->M_perpus->get_data('kategori')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/tambah_buku',$data);
			$this->load->view('admin/footer');
		}
	}

	function edit_buku($id){
		$where = array('id_buku' => $id);
		$data['buku'] = $this->db->query("select * from buku B, kategori K where B.id_kategori=K.id_kategori and B.id_buku='$id'")->result();
		$data['kategori'] =$this->M_perpus->get_data('kategori')->result();
		$data['buku'] = $this->M_perpus->edit_data($where,'buku')->result();
		//$data['buku'] = $this->M_perpus->edit_data($where,'buku')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/editbuku',$data);
		$this->load->view('admin/footer');
	}

	function update_buku(){
		$id = $this->input->post('id');
		$id_kategori = $this->input->post('id_kategori');
		$judul = $this->input->post('judul_buku');
		$pengarang = $this->input->post('pengarang');
		$penerbit = $this->input->post('penerbit');
		$thn_terbit = $this->input->post('thn_terbit');
		$isbn = $this->input->post('isbn');
		$jumlah_buku = $this->input->post('jumlah_buku');
		$lokasi = $this->input->post('lokasi');
		$status_buku = $this->input->post('status_buku');
		$this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required');
		$this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[4]');
		$this->form_validation->set_rules('pengarang', 'Pengarang', 'required|min_length[4]');
		$this->form_validation->set_rules('penerbit', 'Penerbit', 'required|min_length[4]');
		$this->form_validation->set_rules('thn_terbit', 'Tahun Terbit', 'required|min_length[4]');
		$this->form_validation->set_rules('isbn', 'Nomer ISBN', 'required');
		$this->form_validation->set_rules('jumlah_buku', 'Jumlah Buku', 'required|numeric');
		$this->form_validation->set_rules('lokasi', 'Lokasi Buku', 'required|min_length[4]');
		$this->form_validation->set_rules('status_buku', 'Status Buku', 'required');

		if($this->form_validation->run() != false){
			$config['upload_path'] = './assets/upload/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['file_name'] = 'gambar'.'time';

			$this->load->library('upload', $config);

			$where = array('id_buku' => $id);
			$data = array(
				'id_kategori' =>$id_kategori,
				'judul_buku' => $judul,
				'pengarang' => $pengarang,
				'penerbit' => $penerbit,
				'thn_terbit' => $thn_terbit,
				'isbn' => $isbn,
				'jumlah_buku' => $jumlah_buku,
				'lokasi' => $lokasi,
				'gambar' => $gambar['file_name'],
				'tgl_input' => $tgl_input,
				'status_buku' => $status_buku
			);

			if($this->upload->do_upload('gambar')){
			    //proses upload gambar
			  $gambar = $this->upload->data();
			  unlink('assets/upload/'.$this->input->post('old_pict', TRUE));
		      $data['gambar'] = $gambar['file_name'];

			  $this->M_perpus->update_data($where, $data,'buku');
			}else {
			  $this->M_perpus->update_data($where, $data,'buku');
			}

			$this->M_perpus->update_data($where,$data,'buku');
			redirect(base_url().'admin/buku?pesan=berhasil');
		}else{
			$where = array('id_buku' => $id);
			$data['buku'] = $this->db->query("select * from buku B, kategori K where B.id_kategori=K.id_kategori and B.id_buku='$id'")->result();
			$data['kategori'] =$this->M_perpus->get_data('kategori')->result();
			$data['buku'] = $this->M_perpus->edit_data($where,'buku')->result();
			//$data['buku'] = $this->M_perpus->edit_data($where,'buku')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/editbuku',$data);
			$this->load->view('admin/footer');
		}
	}

	function hapus_buku($id){
		$where = array('id_buku' => $id);
		$this->M_perpus->delete_data($where,'buku');
		redirect(base_url().'admin/buku');
	}

	function anggota(){
		$data['anggota'] = $this->M_perpus->get_data('anggota')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/anggota',$data);
		$this->load->view('admin/footer');
	}

	function tambah_anggota(){
		$data['anggota'] =$this->M_perpus->get_data('anggota')->result();
		$this->load->view('admin/header');
		$this->load->view('admin/tambah_anggota',$data);
		$this->load->view('admin/footer');
	}

	function tambah_anggota_act(){
		$nama = $this->input->post('nama_anggota');
		$gender = $this->input->post('gender');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');

		$this->form_validation->set_rules('nama_anggota','Nama Anggota','required');
		$this->form_validation->set_rules('gender','Jenis Kelamin','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('repassword','Konfirmasi Password','required');

		if($this->form_validation->run() != false){
			$data = array(
				'nama_anggota' => $nama,
				'gender' => $gender,
				'no_telp' => $no_telp,
				'alamat' => $alamat,
				'email' => $email,
				'password' => $password
			);

			$this->M_perpus->insert_data($data,'anggota');
			redirect(base_url().'admin/anggota');
		}else{
			$data['anggota'] = $this->M_perpus->get_data('anggota')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/tambah_anggota',$data);
			$this->load->view('admin/footer');
		}
	}

	function edit_anggota($id){
		$where = array('id_anggota' => $id);
		$data['anggota'] = $this->M_perpus->edit_data($where,'anggota')->result();

		$this->load->view('admin/header');
		$this->load->view('admin/edit_anggota',$data);
		$this->load->view('admin/footer');
	}

	function update_anggota(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama_anggota');
		$gender = $this->input->post('gender');
		$no_telp = $this->input->post('no_telp');
		$alamat = $this->input->post('alamat');
		$email = $this->input->post('email');
		$this->form_validation->set_rules('nama_anggota','Nama Anggota','required');
		$this->form_validation->set_rules('gender','Jenis Kelamin','required');
		$this->form_validation->set_rules('no_telp','No Telp','numeric|required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('email','Email','required');
		if($this->form_validation->run() != false){
			$where = array('id_anggota' => $id);
			$data = array(
				'nama_anggota' => $nama,
				'gender' => $gender,
				'no_telp' => $no_telp,
				'alamat' => $alamat,
				'email' => $email
			);
			$this->M_perpus->update_data($where,$data,'anggota');
			redirect(base_url().'admin/anggota?pesan=berhasil');
		}else{
			$where = array('id_anggota' => $id);
			$data['buku'] = $this->M_perpus->edit_data($where,'anggota')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/edit_anggota',$data);
			$this->load->view('admin/footer');

		}
	}

	function hapus_anggota($id){
		$where = array('id_anggota' => $id);
		$this->M_perpus->delete_data($where,'anggota');
		redirect(base_url().'admin/anggota');
	}

	function peminjaman(){

		$data['peminjaman'] = $this->db->query("SELECT * FROM transaksi T, buku B, anggota A WHERE T.id_buku=B.id_buku and T.id_anggota=A.id_anggota")->result();

		$this->load->view('admin/header');
		$this->load->view('admin/peminjaman',$data);
		$this->load->view('admin/footer');
	}

	function tambah_peminjaman(){
		$w = array('status_buku'=>'1');
		$data['buku'] = $this->M_perpus->edit_data($w,'buku')->result();
		$data['anggota'] = $this->M_perpus->get_data('anggota')->result();
		$data['peminjaman'] = $this->M_perpus->get_data('transaksi')->result();

		$this->load->view('admin/header');
		$this->load->view('admin/tambah_peminjaman',$data);
		$this->load->view('admin/footer');
	}

	function tambah_peminjaman_act(){

		$tanggal_pencatatan = date('Y-m-d H:i:s');
		$anggota = $this->input->post('anggota');
		$buku = $this->input->post('buku');
		$tgl_pinjam = $this->input->post('tgl_pinjam');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$denda = $this->input->post('denda');
		$this->form_validation->set_rules('anggota','Anggota','required');
		$this->form_validation->set_rules('buku','Buku','required');
		$this->form_validation->set_rules('tgl_pinjam','Tanggal Pinjam','required');
		$this->form_validation->set_rules('tgl_kembali','Tanggal Kembali','required');
		$this->form_validation->set_rules('denda','Denda','required');

		if($this->form_validation->run() != false){
			$data = array(
			'tgl_pencatatan' => $tanggal_pencatatan,
			'id_anggota' => $anggota,
			'id_buku' => $buku,
			'tgl_pinjam' => $tgl_pinjam,
			'tgl_kembali' => $tgl_kembali,
			'denda' => $denda,
			'tgl_pengembalian' => '0000-00-00',
			'total_denda' => '0',
			'status_pengembalian' => '0',
			'status_peminjaman' => '0'
			);

			$this->M_perpus->insert_data($data,'transaksi');

			// update status buku yg di pinjam
			$d = array('status_buku' => '0', 'tgl_input' => substr($tanggal_pencatatan, 0, 10));
			$w = array('id_buku' => $buku);
			$this->M_perpus->update_data($w,$d,'buku');

			redirect(base_url().'admin/peminjaman');
		}else{
			$w = array('status_buku'=>'1');
			$data['buku'] = $this->M_perpus->edit_data($w,'buku')->result();
			$data['anggota'] = $this->M_perpus->get_data('anggota')->result();

			$this->load->view('admin/header');
			$this->load->view('admin/tambah_peminjaman',$data);
			$this->load->view('admin/footer');
		}
	}

	function checkout($id){
		$w=$this->input->post('id_anggota');
		$data['buku'] = $this->M_perpus->get_data('buku')->result();
		$data['anggota'] = $this->M_perpus->edit_data($w,'anggota')->result();
		$data['peminjaman'] = $this->db->query("select * from transaksi t, anggota a, buku b  where t.id_buku = b.id_buku and t.id_anggota=a.id_anggota and t.id_pinjam='$id'")->result();

		$this->load->view('admin/header');
		$this->load->view('admin/checkout',$data);
		$this->load->view('admin/footer');
	}

	function hapus_peminjaman($id){
		$w = array('id_pinjam' => $id);
		$data = $this->M_perpus->edit_data($w,'transaksi')->row();
		//$data = $this->M_perpus->edit_data($w,'peminjaman')->row();
		$ww = array('id_buku' => $data->id_buku);
		$data2 = array('status_buku' => '1');
		$this->M_perpus->update_data($ww,$data2,'buku');
		$this->M_perpus->delete_data($w,'transaksi');
		redirect(base_url().'admin/peminjaman');
	}

	function transaksi_selesai($id){
		$data['buku'] = $this->M_perpus->get_data('buku')->result();
		$data['anggota'] = $this->M_perpus->get_data('anggota')->result();
		$data['peminjaman'] = $this->db->query("select * from transaksi t, anggota a, buku b  where t.id_buku = b.id_buku and t.id_anggota=a.id_anggota and t.id_pinjam='$id'")->result();

		$this->load->view('admin/header');
		$this->load->view('admin/transaksi_selesai',$data);
		$this->load->view('admin/footer');
	}

	function transaksi_selesai_act(){
		$id = $this->input->post('id');
		$tgl_dikembalikan = $this->input->post('tgl_dikembalikan');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$buku = $this->input->post('buku');
		$denda = $this->input->post('denda');
		$this->form_validation->set_rules('tgl_dikembalikan','Tanggal Di Kembalikan','required');
		if($this->form_validation->run() != false){
		// menghitung selisih hari
			$batas_kembali = strtotime($tgl_kembali);
			$dikembalikan = strtotime($tgl_dikembalikan);
			$selisih = abs(($batas_kembali - $dikembalikan)/(60*60*24));
			$total_denda = $denda*$selisih;
			// update status peminjaman
			$data = array('status_peminjaman' => '1', 'total_denda' => $total_denda,'tgl_pengembalian' => $tgl_dikembalikan,'status_pengembalian' => '1');
			//$data3 = array();
			$w = array('id_pinjam' => $id);
			$this->M_perpus->update_data($w,$data,'transaksi');
			//$this->M_perpus->update_data($w,$data3,'detail_pinjam');
			// update status buku
			$data2 = array('status_buku' => '1');
			$w2 = array('id_buku' => $buku);
			$this->M_perpus->update_data($w2,$data2,'buku');

			redirect(base_url().'admin/peminjaman');
		}else{
			$data['buku'] = $this->M_perpus->get_data('buku')->result();
			$data['anggota'] = $this->M_perpus->get_data('anggota')->result();
			$data['peminjaman'] = $this->db->query("select * from peminjaman p, anggota a, detail_pinjam d, buku b  where p.id_anggota = a.id_anggota and p.id_pinjam = d.id_pinjam and d.id_buku = b.id_buku and p.id_pinjam='$id'")->result();

			$this->load->view('admin/header');
			$this->load->view('admin/transaksi_selesai',$data);
			$this->load->view('admin/footer');
		}
	}
		function laporan_buku(){
			$data['buku'] = $this->M_perpus->get_data('buku')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/laporan_buku', $data);
			$this->load->view('admin/footer');
	}
		function laporan_print_buku(){
			$data['buku'] = $this ->M_perpus->get_data('buku')->result();
			$this->load->view('admin/laporan_print_buku', $data);
		}
		function laporan_anggota(){
			$data['anggota'] = $this->M_perpus->get_data('anggota')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/laporan_anggota', $data);
			$this->load->view('admin/footer');
	}
		function laporan_print_anggota(){
			$data['anggota'] = $this ->M_perpus->get_data('anggota')->result();
			$this->load->view('admin/laporan_print_anggota', $data);
		}
		function laporan_transaksi(){
			$data['transaksi'] = $this->M_perpus->get_data('transaksi')->result();
			$this->load->view('admin/header');
			$this->load->view('admin/laporan_transaksi', $data);
			$this->load->view('admin/footer');
	}
		function laporan_print_transaksi(){
			$data['transaksi'] = $this ->M_perpus->get_data('transaksi')->result();
			$this->load->view('admin/laporan_print_transaksi', $data);
		}
}
