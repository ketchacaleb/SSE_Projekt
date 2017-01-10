<?php if(!defined('BASEPATH'))  exit('no direct script access allowed');

class Page_management extends CI_Controller
{
   function __construct()
      {
         parent::__construct();
         if ($this->session->userdata('logged_in') != 1) {
             redirect(base_url() . 'index.php/welcome/login');
         }
     }

    public function home()
    {
        $this->load->view('view/head');
        $this->load->view('page_management/welcome_message');
        $this->load->view('view/footer');
    }
    public function pay_area()
    {
        $this->load->view('view/head');
        $this->load->view('page_management/pay');
        $this->load->view('view/footer');
    }
    public function club()
    {
        $this->load->view('view/head');
        $this->load->view('page_management/club_area');
        $this->load->view('view/footer');
    }
    public function health()
    {
        $this->load->view('view/head');
        $this->load->view('page_management/health_area');
        $this->load->view('view/footer');
    }
    public function event()
    {
        $this->load->view('view/head');
        $this->load->view('page_management/event_area');
        $this->load->view('view/footer');
    }
    public function info()
    {
        $this->load->view('view/head');
        $this->load->view('page_management/information_area');
        $this->load->view('view/footer');
    }
    public function borommee()
    {
        $table = '<table width="40" class="table table-condensed table-striped">
             <thead>
                <tr>
                     <th></th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Statu</th>
                    <th>Annee adhesion</th>
                </tr>
            </thead><tbody>';
        $adr_q = $this->db->query("SELECT * from adherant");
        $adr_r = $adr_q->result_array();
        foreach ($adr_r as $adr) {
            $table .= '<tr>
                        <td><button class="btn btn-primary btn-block edit_member" $member_id="'.$adr['adherant_ID'].'""><span class="glyphicon glyphicon-pencil"></span</button></td>
                        <td>'.$adr['name'].'</td>
                        <td>'.$adr['vorname'].'</td>
                        <td>'.$adr['statu'].'</td>
                        <td>'.$adr['annee'].'</td>
                    </tr>';
        }
        $data['table'] = $table.'<tr><td colspan="5"><button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#create_dhr">Ajouter un Adherant</button></td></tr></tbody></table>';
        $this->load->view('view/head');
        $this->load->view('page_management/borommee',$data);
        $this->load->view('view/footer');
    }
    public function add_user(){
        $email = $this->input->post('email');
        $passwort = $this->input->post('passwort');
        $add_q = $this->db->get_where('usersScans', array('email' => $email, 'password' => hash('sha256', $passwort)));
        if($email != null && $passwort != null){
            $pword_length = strlen($passwort);
            if($pword_length < 6){
                print 'pword failed';
            }else {
                if ($add_q->num_rows() == 0) {
                    $insert = array('email' => $email,'password' => hash('sha256',$passwort));
                    $this->db->insert('usersScans',$insert);
                    print 'success';
                } else {
                    print 'error';
                }
            }
        }else{
            print 'failed';
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
        $check_pw_q = $this->db->get_where('usersScans', array('password' => hash('sha256',$old_pw), 'email' => $email));
        if($check_pw_q->num_rows() > 0){
            if($new_pw == $repeat_newpw){
                $single_array = array('passwort' => hash('sha256',$new_pw));
                $this->db->where('passwort',hash('sha256',$old_pw));
                $this->db->update('usersScans',$single_array);
                print 'success';
            }else{
                print 'error';
            }
        }else{
            print 'failed';
        }
    }
    public function member_details($id){
        $member_q = $this->db->get('adherant', array('adherant_ID' => $id));
        $mber_r = $member_q->row_array();

    }
    public function member_form(){
        $men_id = $this->input->post('id');
        $men_q = $this->db->get_where('adherant', array('adherant_ID' => $men_id));
        $mem = $men_q->row_array();
        $formular = '<table class="table table-condensed table-striped">
                        <tbody>
                            <tr>
                                <td colspan="1" width="25%">ID</td>
                                <td colspan="1" width="25%"></td>
                                <td colspan="2" width="25%"><span id="eMid">'.$mem['adherant_ID'].'</span></td>
                            </tr>
                            <tr>
                                <td colspan="4"><input type="text" value="'.$mem['name'].'" class="form-control" id="eName" placeholder="Nom de adherant"></td>
                            </tr>
                             <tr>
                                <td colspan="4"><input type="text" value="'.$mem['vorname'].'" class="form-control" id="eVorname" placeholder="Prenom de adherant"></td>
                            </tr>
                             <tr>
                                <td colspan="4"><input type="text" value="'.$mem['statu'].'" class="form-control" id="eStatu" placeholder="Statut"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><input type="text" value="'.$mem['annee'].'" class="form-control" id="eAnnee" placeholder="Annee"></td>
                            </tr>
                        </tbody>
                    </table>';
        print $formular;
    }
    public function update_member(){
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $vorname = $this->input->post('vorname');
        $statu = $this->input->post('statu');
        $annee = $this->input->post('annee');
        $update_array = array(
            'name' => $name,
            'vorname' => $vorname,
            'statu' => $statu,
            'annee' => $annee
        );
        $this->db->where('adherant_ID',$id);
        $this->db->update('adherant', $update_array);

    }
    public function add_member(){
        $name = $this->input->post('name');
        $vorname = $this->input->post('vorname');
        $statu = $this->input->post('statu');
        $annee = $this->input->post('annee');
        $insert_array = array(
            'name' => $name,
            'vorname' => $vorname,
            'statu' => $statu,
            'annee' => $annee
        );
        $this->db->insert('adherant',$insert_array);
    }
}
