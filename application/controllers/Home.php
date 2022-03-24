<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->db_two = $this->load->database('db2', TRUE);
  }


  public function index()
  {
    // mengetahui struktur tabel
    $statement = $this->db_two->query('DESCRIBE aktivis')->result_array();

    foreach ($statement as $attr) {
      echo $attr['Field'] . '<br>';
    }

    // mengambil data dari tabel
    $result = $this->db->get('mahasiswa')->result_array();
    foreach ($result as $key) {
      $data[] = [
        'id' => $key['id_mhs'],
        'nama' => $key['nama_mhs'],
        'jns_kelamin' => $key['jns_kelamin'],
        'tgl_lahir' => $key['tgl_lahir']
      ];
    }
    // $hasil = $this->db_two->insert_batch('aktivis', $data);

    // echo $hasil;
  }
}
  
  /* End of file Home.php */
