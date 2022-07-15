<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Config_db extends CI_Model
{
    private $_table = "config";

    public $id_conf;
    public $host_db;
    public $username_db;
    public $pass_db;
    public $port_db;

    public function __construct()
    {
        parent::__construct();
    }

    
}