<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
function __construct(){
		parent::__construct();
		//cek login
		if($this->session->userdate('status') != "login"){
			$alert=$this->session->set_flashdata('alert', 'Anda Belum Login');
		redirect(base_url());
		}
	}

	function index(){
		$data['anggota'] = $this->M_perpus->get_data("anggota")->result();
		$data['buku'] = $this->M_perpus->get_data("buku")->result();
		
		$data['header'] = 'Katalog Buku';
	}

	public function katalog_detail(){
		$id = $this->uri->segmen(3);
		$buku = $this->db->query('select*from buku b, kategori k where b.id_kategori and b.id.buku='.$id)->result();

			foreach ($buku as $fields) {
				$data['judul'] = $fields->judul_buku;
				$data['pengarang'] = $fields->pengarang;
				$data['penerbit'] = $fields->penerbit;
				$data['kategori'] = $fields->nama_kategori;
				$data['tahun'] = $fields->thn_terbit;
				$data['isbn'] = $fields->isbn;
				$data['gambar'] = $fields->gambar;
				$data['id'] = $id;
			}
			$this->load->view('desain');
			$this->load->view('toplayout');
			$this->load->view('detail_buku',$data);
			}
	}
?>