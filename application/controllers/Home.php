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

    $data['tabel'] = $this->db->query('SHOW TABLES')->result_array();


    // $hasil = $this->db_two->insert_batch('aktivis', $data);

    $this->load->view('home_v', $data);
  }

  public function getTables()
  {
    // $dbname = $_POST['db1'];
    // $db = new PDO("mysql:host=localhost;dbname=$dbname", "root", "");
    // $query = $db->prepare('show tables');
    // $query->execute();
    // $tabe_in = 'Tables_in_' . $dbname;
    // $results = $query->fetch(PDO::FETCH_ASSOC);
    // while ($results != null) {
    //   // change <li> to <option> here **********
    //   echo '<option>', $results[$tabe_in], '</option>';
    //   $results = $query->fetch(PDO::FETCH_ASSOC);
    // }

    $db1 = $_POST['dbs1'];
    $db2 = $_POST['dbs2'];

    $this->db1 = $this->load->database($db1, true);
    $this->db2 = $this->load->database($db2, true);

    $data['hasilDB1'] = $this->db1->query('SHOW TABLES')->result_array();
    $data['hasilDB2'] = $this->db2->query('SHOW TABLES')->result_array();

    echo json_encode($data);
  }

  public function getAttr()
  {
    $database1 = $_POST['dbs1'];
    $database2 = $_POST['dbs2'];
    $table1 = $_POST['tb1'];
    $table2 = $_POST['tb2'];


    $hasilAttr['attr1'] = $this->Migrate->describeTable1($database1, $table1);
    $hasilAttr['attr2'] = $this->Migrate->describeTable2($database2, $table2);

    echo json_encode($hasilAttr);
  }

  // public function importDB()
  // {
  //   $statement = $this->Migrate->describeTable(2, 'aktivis');
  //   foreach ($statement as $value) {
  //     $attr[] = $value['Field'];
  //   }

  //   print_r($attr);

  //   // mengambil data dari tabel
  //   $result = $this->db->get('mahasiswa')->result_array();
  //   foreach ($result as $key) {
  //     $hasil[] = [
  //       'id' => $key['id_mhs'],
  //       'nama' => $key['nama_mhs'],
  //       'jns_kelamin' => $key['jns_kelamin'],
  //       'tgl_lahir' => $key['tgl_lahir']
  //     ];
  //   }
  // }
}
  
  /* End of file Home.php */
