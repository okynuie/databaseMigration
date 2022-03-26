<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->db_two = $this->load->database('db2', TRUE);
  }

  public function describeTable($DB, $table)
  {
    if ($DB == 1) {
      $statement = $this->db->query('DESCRIBE ' . $table)->result_array();
    } elseif ($DB == 2) {
      // mengetahui struktur tabel
      $statement = $this->db_two->query('DESCRIBE ' . $table)->result_array();
    }

    return $statement;
  }
}
  
  /* End of file Migration.php */
