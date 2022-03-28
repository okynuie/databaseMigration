<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends CI_Model
{
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

  public function import($db, $tb, $data)
  {
    $this->db2 = $this->load->database($db, true);
    return $this->db2->insert_batch($tb, $data);
  }
}
  
  /* End of file Migration.php */
