<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends CI_Model
{

  public function conn()
  {
    // koneksi manual untuk mengambil list database
    $db = new PDO('mysql:host=localhost;dbname=mysql', 'root', '');
    $dbs = $db->query('SHOW DATABASES');

    while (($db = $dbs->fetchColumn(0)) !== false) {
      $databases[] = $db;
    };
    return $databases;
  }

  public function loadDB1($db1, $tb1, $field1)
  {
    // load database secara manual
    $this->db1 = $this->load->database($db1, true);
    // mengambil data(value) atribut dari database lama
    $this->db1->select($field1);
    return $this->db1->get($tb1)->result_array();
  }

  public function describeTable1($DB1, $table1)
  {
    $this->db1 = $this->load->database($DB1, true);
    return $this->db1->query('DESCRIBE ' . $table1)->result_array();
  }

  public function describeTable2($DB2, $table2)
  {
    $this->db2 = $this->load->database($DB2, true);
    return $this->db2->query('DESCRIBE ' . $table2)->result_array();
  }

  public function import()
  {
    $post = $this->input->post();

    // database dari element select
    $db1 = $post['databases1'];
    $db2 = $post['databases2'];

    // tabel dari element select
    $tb1 = $post['tables1'];
    $tb2 = $post['tables2'];


    // mengambil atribut tabel lama dari element select yang sudah dipilih
    $count = $this->input->post('count1');
    for ($x = 1; $x <= $count; $x++) {
      $field1[] = $this->input->post('attr' . $x, true);
    }

    // mengambil atribut tabel baru
    for ($y = 1; $y <= $count; $y++) {
      $field2[] = $this->input->post('attrBaru' . $y, true);
    }

    // mengambil data(value) atribut dari database lama
    $dataAttr = $this->Migrate->loadDB1($db1, $tb1, $field1);

    // menyocokan atribut database lama dengan atribut yang telah dipilih melalui element select
    foreach ($field1 as $f1) {
      foreach ($dataAttr as $key) {
        $newData1[] = $key[$f1];
      }
      $data1[] =  $newData1;
      $newData1 = array();
    }

    // jumlah data yang akan diimport
    $row = count($data1[0]);
    // memasukkan atribut lama kedalam atribut baru dalam bentuk array dua dimensi
    // array tampung
    $c = array();
    for ($i = 0; $i < $row; $i++) {
      for ($j = 0; $j < $count; $j++) {
        $c[$field2[$j]] = $data1[$j][$i];
      }
      $hasilAttr[] = $c;
      $c = array();
    }

    $this->db = $this->load->database($db2, true);
    return $this->db->insert_batch($tb2, $hasilAttr);
  }
}
  
  /* End of file Migration.php */
