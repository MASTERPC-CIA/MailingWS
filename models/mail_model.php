<?php 

class Mail_Model extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

    public function send_email($smtp_user, $smtp_pass, $email_from, $name_from , $email_to, $title, $menssage){
    	$this->load->library('email');
        $this->email->initialize(array(
               'protocol' => 'smtp',
               'smtp_host' => 'smtp.mandrillapp.com',
               'smtp_user' => $smtp_user,
               'smtp_pass' => $smtp_pass,
               'smtp_port' => 587,
               'mailtype' => 'html',
               'crlf' => "\r\n",
               'newline' => "\r\n"
            ));

		 $this->email->from($email_from, $name_from);
		 $this->email->to($email_to);
		 $this->email->subject($title);
		 //$this->email->message($this->load->view('email_view',TRUE));//Load a view into email body
		 $this->email->message($menssage);//Load a view into email body
		 $send = $this->email->send();
		 if($send){
		 	return true;
		 }else{
		 	return NULL;
		 }
    }

    public function get($id = null){
    	if(!is_null($id)){
    		$query = $this->db->select('*')->from('users_api')->where('id',$id)->get();
    		if($query->num_rows() == 1){
    			return $query->row_array();
    		}
    		return null;

    	}

    		$query = $this->db->select('*')->from('users_api')->get();
    		if($query->num_rows() > 0){
    			return $query->result_array();
    		}
    		return null;
    }

    public function save($user){
    	$this->db->set($this->_setUser($user))->insert('users_api');

    	if($this->db->affected_rows() == 1){
    		return $this->db->insert_id();
    	}
    	return null;
    }

    public function update($id , $user){
    	$this->db->set($this->_setUser($user))->where('id'.$id)->update('users_api');

    	if($this->db->affected_rows() == 1){
    		return true;
    	}
    	return null;
    }

    public function _setUser($user){
    	return  array(
    		'id' =>$user['id'] ,
    		'username' =>$user['username'] ,
    		'password' =>$user['password'] ,
    		'register_date' =>$user['register_date'] 

    		);
    }
}