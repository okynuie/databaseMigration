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

  public function loadDB1($db1, $db2, $tb1, $tb2, $field1, $excep, $excep2)
  {
    $atribut = '';
    foreach ($field1 as $key) {
      if ($key != '0') {
        $atribut .= $tb1 . '.' . $key . ', ';
      } else {
        $atribut .= $key . ', ';
      }
    }

    $ex = '';
    for ($i = 0; $i < count($excep); $i++) {
      if ($ex !== '') {
        $ex .= ' AND ';
      } else {
        $ex .= $tb1 . '.' . $excep[$i] . ' = ' . $tb2 . '.' . $excep2[$i];
      }
    }

    // load database secara manual
    $this->db1 = $this->load->database($db1, true);

    // mengambil data(value) atribut dari database lama
    $this->db1->distinct();
    $this->db1->select($atribut);
    $this->db1->join($db2 . '.' . $tb2, $ex, 'left');
    $this->db1->where($tb2 . '.' . $excep2[0] . ' IS NULL');

    return $this->db1->get($tb1)->result_array();
  }

  public function describeTable($DB, $table)
  {
    $this->db1 = $this->load->database($DB, true);
    return $this->db1->query('DESCRIBE ' . $table)->result_array();
  }

  public function read($dbs, $tb1)
  {
    $this->db1 = $this->load->database($dbs, true);
    $this->db1->distinct('id');
    return $this->db1->get($tb1)->result_array();
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

    // variabel untuk mengetahui jumlah atribut
    $count = $post['count1'];

    // mengetahui atribut yang dijadikan patokan redudancy data
    $excep = explode(',', $post['countExcep']);
    $excep2 = explode(',', $post['countExcep2']);

    // mengambil atribut tabel lama dari element select yang sudah dipilih
    for ($x = 1; $x <= $count; $x++) {
      $field1[] = $this->input->post('attr' . $x, true);
    }

    // mengambil atribut tabel baru
    for ($y = 1; $y <= $count; $y++) {
      $field2[] = $this->input->post('attr' . $y . 'Baru', true);
    }

    // mengambil data(value) atribut dari database lama
    $dataAttr = $this->Migrate->loadDB1($db1, $db2, $tb1, $tb2, $field1, $excep, $excep2);

    // memindahkan data dari atribut lama kedalam array untuk atribut baru
    foreach ($dataAttr as $value) {
      for ($i = 0; $i < count($field2); $i++) {
        if ($field1[$i] == 'no_medrec') {
          $c[$field2[$i]] = str_pad($value[$field1[$i]], 6, '0', STR_PAD_LEFT);
        } elseif ($field1[$i] == 'pekerjaan_id') {
          if ($value[$field1[$i]] == 1) {
            $c[$field2[$i]] = 'BLM BEKERJA';
          } elseif ($value[$field1[$i]] == 2) {
            $c[$field2[$i]] = 'PEGAWAI NEGERI';
          } elseif ($value[$field1[$i]] == 3) {
            $c[$field2[$i]] = 'KARYAWAN SWASTA';
          } elseif ($value[$field1[$i]] == 4) {
            $c[$field2[$i]] = 'TNI';
          } elseif ($value[$field1[$i]] == 5) {
            $c[$field2[$i]] = 'TKS';
          } elseif ($value[$field1[$i]] == 6) {
            $c[$field2[$i]] = 'WIRASWASTA';
          } elseif ($value[$field1[$i]] == 7) {
            $c[$field2[$i]] = 'PURNAWIRAWAN';
          } elseif ($value[$field1[$i]] == 8) {
            $c[$field2[$i]] = 'PENSIUNAN';
          } elseif ($value[$field1[$i]] == 9) {
            $c[$field2[$i]] = 'PELAJAR';
          } elseif ($value[$field1[$i]] == 10) {
            $c[$field2[$i]] = 'MAHASISWA';
          } elseif ($value[$field1[$i]] == 11) {
            $c[$field2[$i]] = 'IBU RMH TANGGA';
          } elseif ($value[$field1[$i]] == 16) {
            $c[$field2[$i]] = 'LAIN-LAIN';
          } elseif ($value[$field1[$i]] == 17) {
            $c[$field2[$i]] = 'POLRI';
          } elseif ($value[$field1[$i]] == 19) {
            $c[$field2[$i]] = 'NELAYAN';
          } elseif ($value[$field1[$i]] == 20) {
            $c[$field2[$i]] = 'DOKTER';
          } elseif ($value[$field1[$i]] == 22) {
            $c[$field2[$i]] = 'GURU';
          } elseif ($value[$field1[$i]] == 23) {
            $c[$field2[$i]] = 'PETANI';
          } else {
            $c[$field2[$i]] = '-';
          }
        } else {
          $c[$field2[$i]] = $value[$field1[$i]];
        }
      }
      $hasilAttr[] = $c;
    }

    $this->db = $this->load->database($db2, true);
    return $this->db->insert_batch($tb2, $hasilAttr);
  }
}
  
  /* End of file Migration.php */
