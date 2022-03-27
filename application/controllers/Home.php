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
    // koneksi manual untuk mengambil list database
    $db = new PDO('mysql:host=localhost;dbname=mysql', 'root', '');
    $dbs = $db->query('SHOW DATABASES');

    while (($db = $dbs->fetchColumn(0)) !== false) {
      $databases[] = $db;
    };

    $data['dbs'] = $databases;

    $this->load->view('home_v', $data);
  }

  public function getTables()
  {
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

  public function importDB()
  {
    // database dari element select
    $db1 = $this->input->post('databases1', true);
    $db2 = $this->input->post('databases2', true);

    // tabel dari element select
    $tb1 = $this->input->post('tables1', true);
    $tb2 = $this->input->post('tables2', true);

    // mengambil atribut tabel lama dari element select yang sudah dipilih
    $count = $this->input->post('count1');
    for ($x = 1; $x <= $count; $x++) {
      $field1[] = $this->input->post('attr' . $x, true);
    }

    // mengambil atribut tabel baru
    for ($y = 1; $y <= $count; $y++) {
      $field2[] = $this->input->post('attrBaru' . $y, true);
    }

    // load database secara manual
    $this->db1 = $this->load->database($db1, true);
    $this->db2 = $this->load->database($db2, true);

    // mengambil data(value) atribut dari database lama
    $this->db1->select($field1);
    $dataAttr = $this->db1->get($tb1)->result_array();

    // menyocokan atribut database lama dengan atribut yang telah dipilih melalui element select
    foreach ($field1 as $f1) {
      foreach ($dataAttr as $key) {
        $newData1[] = $key[$f1];
      }
      $data1[] =  $newData1;
      $newData1 = array();
    }

    // memasukkan atribut lama kedalam atribut baru dalam bentuk array dua dimensi
    $c = array();
    for ($i = 0; $i <= count($data1); $i++) {
      for ($j = 0; $j < $count; $j++) {
        $c[$field2[$j]] = $data1[$j][$i];
      }
      $hasilAttr[] = $c;
      $c = array();
    }

    // menyimpan kedalam database baru
    $this->db2->insert_batch($tb2, $hasilAttr);

    // kembali ke home
    redirect('home');
  }
}
  
  /* End of file Home.php */
