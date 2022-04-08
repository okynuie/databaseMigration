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
    $data['dbs'] = $this->Migrate->conn();

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


    $hasilAttr['attr1'] = $this->Migrate->describeTable($database1, $table1);
    $hasilAttr['attr2'] = $this->Migrate->describeTable($database2, $table2);

    echo json_encode($hasilAttr);
  }

  public function getTypeData()
  {
    $table1 = $_POST['tb1'];
    $database1 = $_POST['dbs1'];

    $hasilAttr = $this->Migrate->describeTable($database1, $table1);
    echo json_encode($hasilAttr);
  }

  public function getDataTable()
  {
    $data = 'ok';

    echo json_encode($data);
  }

  public function importDB()
  {
    // menyimpan kedalam database baru
    $this->Migrate->import();

    // kembali ke home
    redirect('home');
  }
}
  
  /* End of file Home.php */
