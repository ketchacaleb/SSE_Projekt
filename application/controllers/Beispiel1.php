<?php

/**
 * Created by PhpStorm.
 * User: Ketcha
 * Date: 04.11.2016
 * Time: 12:02
 */

/* Link:   C:\Users\Ketcha\PhpstormProjects\SSE_Projekt\application\controllers\Beispiel1*/
class Beispiel1
{

    public $cache_file;

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != 1) {
            redirect(base_url() . 'index.php/welcome/login');
        }
        // some PHP code...
    }

    function __destruct()
    {
        $file = "/var/www/cache/tmp/{$this->cache_file}";
        if (file_exists($file)) @unlink($file);
    }
}

// some PHP code...
$user_data = unserialize($_GET['data']);

// some PHP code...