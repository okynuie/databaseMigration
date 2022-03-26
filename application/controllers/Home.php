<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Migrate');
  }


  public function index()
  {
    $db = new PDO('mysql:host=localhost;dbname=mysql', 'root', '');
    $dbs = $db->query('SHOW DATABASES');

    while (($db = $dbs->fetchColumn(0)) !== false) {
      $databases[] = $db;
    };

    $data['dbs'] = $databases;
    $data['statement'] = $this->Migrate->describeTable('1', 'mahasiswa');
    $data['mhs'] = $this->db->get('mahasiswa')->result_array();

    $data['tabel'] = $this->db->query('SHOW TABLES')->result_array();


    // $hasil = $this->db_two->insert_batch('aktivis', $data);

    $this->load->view('home_v', $data);
  }

  public function getTable()
  {
    $statement = $this->Migrate->describeTable('1', 'mahasiswa');

    echo json_encode($statement);
  }

  public function importDB()
  {
    $statement = $this->Migrate->describeTable(2, 'aktivis');
    foreach ($statement as $value) {
      $attr[] = $value['Field'];
    }

    print_r($attr);

    // mengambil data dari tabel
    $result = $this->db->get('mahasiswa')->result_array();
    foreach ($result as $key) {
      $hasil[] = [
        'id' => $key['id_mhs'],
        'nama' => $key['nama_mhs'],
        'jns_kelamin' => $key['jns_kelamin'],
        'tgl_lahir' => $key['tgl_lahir']
      ];
    }
  }
}
  
  /* End of file Home.php */
