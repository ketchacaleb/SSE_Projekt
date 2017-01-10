<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function login()
    {
        #print hash('sha256', 'aurevoir');
        $this->load->view('page_management/login');
    }
    public function check_login(){
        $email = $this->input->post('email');
        $passwort = $this->input->post('passwort');
        $login_q = $this->db->get_where('usersScans', array('email' => $email, 'passwort' => hash('sha256', $passwort)));
        if($email != null && $passwort != null){
            $pword_length = strlen($passwort);
            if($pword_length < 6){
                print 'pword failed';
            }else {
                if ($login_q->num_rows() > 0) {
                    $login = $login_q->row_array();
                    $login['logged_in'] = 1;
                    $this->session->set_userdata($login);
                    print 'success';
                } else {
                    print 'error';
                }


            } 
        }else{
            print 'failed';
        }
    }
}
