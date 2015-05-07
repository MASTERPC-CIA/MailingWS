<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require(APPPATH.'libraries/REST_Controller.php');
	
class Send_Mail extends REST_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('send_model');
    }

    public function send_post(){
        $envio = $this->send_model->send_email(
            $this->post('email_from'),
            $this->post('name_from') ,
            $this->post('email_to'),
            $this->post('title'),
            $this->post('msg')
          );
        if($envio > 0){
          $this->response(array('response' => $envio),200);
        }else{
          $this->response(array('error' => 'No se pudo enviar el correo!!'),404);
        }
    }
    
}