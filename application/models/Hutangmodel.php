<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * 
	 */
	class Hutangmodel extends CI_Model
	{
		
		function __construct()
		{
			# code...
			parent::__construct();
		}
		function get_hutang()
		{
			return $this->db->get('tampilhutang')->result();
		}
		function id_hutang()
		{
			$this->db->select('MAX(RIGHT(hutang.id_hutang,3)) AS id_hutang', FALSE);
			$this->db->order_by('id_hutang','Desc');
			$this->db->limit(1);
			$query = $this->db->get('hutang');
			if ($query->num_rows() <> 0) {
				# code...
				$data = $query->row();
				$id = intVal($data->id_hutang) + 1;
			}else{
				$id = 1;
			}
			$batas = str_pad($id, 3,"0", STR_PAD_LEFT);
			// foreach ($que as $key) {
			// 	# code...
			// 	$id_barang_tampil = $batas;
			// }
			$id_barang_tampil =$batas;
			return $id_barang_tampil;
		}
		function tambah()
		{
			$id_hutang = $this->input->post('idhutang');
			$nama = $this->input->post('nama_pelanggan');
			$id_user = $this->db->get('user', array('nama' => $nama ))->result();
			$total_hutang = $this->input->post('jumlah_hutang');
			$jatuh_tempo = $this->input->post('jatuh_tempo');
			$data = array(
				'id_hutang' => $id_hutang,
				'id_user' => $id_user,
				'total_hutang' =>$total_hutang,
				'jatuh_tempo' => $jatuh_tempo
			);
			$this->db->insert('hutang',$data);
		}
		function getid($nama)
		{
			return $this->db->get('user', array('nama' => $nama ))->result();
		}
	}
?>