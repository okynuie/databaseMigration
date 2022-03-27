<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    // $this->db_two = $this->load->database('db2', TRUE);
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
