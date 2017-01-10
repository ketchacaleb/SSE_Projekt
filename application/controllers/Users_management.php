<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_management extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') != 1) {
            redirect(base_url() . 'index.php/welcome/login');
        }
    }
    public function show_change_pw()
    {
        $this->load->view('view/head');
        $this->load->view('page_management/change_pw');
        $this->load->view('view/footer');
    }
    public function show_user()
    {
        $this->load->view('view/head');
        $this->load->view('page_management/add_user');
        $this->load->view('view/footer');
    }
    public function show_delete_user()
    {
        $this->load->view('view/head');
        $this->load->view('page_management/delete_user');
        $this->load->view('view/footer');
    }
    public function add_user(){
        $admin = $this->input->post('admin');
        $email = $this->input->post('email');
        $passwort = $this->input->post('passwort');
        $seach_ad = $this->db->get_where('usersScans', array('admin' => $admin));
        $add_q = $this->db->get_where('usersScans', array('email' => $email, 'passwort' => hash('sha256', $passwort),'admin' => $admin));
        if($seach_ad->num_rows() > 0) {
            if ($email != null && $passwort != null && $admin != null) {
                $pword_length = strlen($passwort);
                if ($pword_length < 6) {
                    print 'pword failed';
                } else {
                    if ($add_q->num_rows() == 0) {
                        $insert = array('email' => $email, 'passwort' => hash('sha256', $passwort));
                        $this->db->insert('usersScans', $insert);
                        print 'success';
                    } else {
                        print 'error';
                    }
                }
            } else {
                print 'failed';
            }
        }else{
            print 'added failed';
        }

    }
    public function delete_user(){
        $email = $this->input->post('email');
        $delete_q = $this->db->get_where('usersScans', array('email' => $email));
        if($delete_q->num_rows() != 0){
            $this->db->delete('usersScans', array('email' => $email));
            print 'success';
        }else{
            print 'failed';
        }

    }
    public function change_password(){
        $email = $old_pw = $this->input->post('email');
        $old_pw = $this->input->post('oldpw');
        $new_pw = $this->input->post('newpw');
        $repeat_newpw = $this->input->post('rnewpw');
        $check_pw_q = $this->db->get_where('usersScans', array('passwort' => hash('sha256',$old_pw), 'email' => $email));
        if($check_pw_q->num_rows() > 0){
            if($new_pw == $repeat_newpw){
                $single_array = array('password' => hash('sha256',$new_pw));
                $this->db->where('password',hash('sha256',$old_pw));
                $this->db->update('usersScans',$single_array);
                print 'success';
            }else{
                print 'error';
            }
        }else{
            print 'failed';
        }
    }
}