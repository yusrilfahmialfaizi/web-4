<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Hutang extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model("Hutangmodel");
		$this->load->model("Usermodel");
	}

	function index()
	{
		if($this->session->userdata('status') != "login" || $this->session->userdata("jabatan") != "Admin"){
					redirect(base_url("admin"));
		}
		// $data['id'] = $this->Hutangmodel->id_hutang();
		$data['hutang'] = $this->Hutangmodel->get_hutang();
		$data['user'] = $this->Usermodel->getUser();
		$this->load->view('_partial/header');
		$this->load->view('menu/hutang', $data);
	}
	function tambahHutang()
	{
		$this->Hutangmodel->tambah();
		redirect('admin/kasir/hutang');	
	}
	function updateHutang()
	{
		$this->Hutangmodel->update();
		redirect('admin/kasir/hutang');
	}
	function get_id()
	{
		$kode = $this->input->post('nama');
		$data = $this->Hutangmodel->getid($kode);
		echo json_encode($data);
	}
}
?>