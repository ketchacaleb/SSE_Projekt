<?php
    if(!defined('BASEPATH'))
        exit('no direct script access alowed');

 class Scan_ebay extends CI_Controller {
    public function scan_de(){
        $this->load->helper("simplehtmldom_helper");
        $link = "https://www.ebay-kleinanzeigen.de/s-frankfurt-%28main%29/laptop/k0l4292";
        $open_link = file_get_html($link);
        print $open_link->outertext;
    }
}