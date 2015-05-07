<?php
require(APPPATH.'libraries/REST_Controller.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

	
class Service_Mailing extends REST_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mail_model');
    }

    public function send_get(){
//        if (true) {
          # code...
          /*$envio = $this->mail_model->send_email(
            $this->post('smtp_user'),
             $this->post('smtp_pass'),
              $this->post('email_from'),
              $this->post('name_from') ,
              $this->post('email_to'),
              $this->post('title'),
              $this->post('menssage')
          );*/
          $envio = $this->mail_model->send_email(
            'dannyjimenez110@gmail.com',
             'u76rscKU1KeKZn2__mnBrA',
              'danny_110@hotmail.com',
              'Daniel Jimenez' ,
              'dannyjimenez110@gmail.com',
              'Titulo del mensaje',
              "hola este es un mensaje de prueba"
          );
          if($envio){
            $this->response(array('response' => $envio),200);
          }else{
            $this->response(array('error' => 'No se pudo enviar el correo!!'),404);
          }
//        }
    }

    public function index_get(){
      $user = $this->mail_model->get();
      if (!is_null($user)) {
        # code...
        $this->response(array('response' => $user),200);
      }else {
        # code...
        $this->response(array('error' => 'No hay usuarios'),404);
      }
          
    }

    public function find_get($id){
        if(empty($id)){
            $this->response(NULL,404);
        }
      $user = $this->mail_model->get($id);
      if (!is_null($user)) {
        # code...
        $this->response(array('response' => $user),200);
      }else {
        # code...
        $this->response(array('error' => 'No existe usuario con el id '.$id),404);
      }
    }

    public function index_post(){
         if(empty($this->post('user'))){
            $this->response(NULL,404);
        }
        $user_id = $this->mail_model->save($this->post('user'));
        if (! is_null($user_id)) {
          # code...
          $this->response(array('response'=>$user_id),200);
        }else{
          $this->response(array('error' => 'Ha ocurrido un error'),404);
        }
    }

    public function index_delete($id){
      
    }

    public function index_put($id){
      
    }
   /* function mails_post(){

        $result = $this->user_model->update( $this->post(), array(
            'name' => $this->post('name'),
            'email' => $this->post('email')
        ));
         
        if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }
        
    }*/
    
//     public function send_mails(){
//         //$this->load->library('mandrill', array('u76rscKU1KeKZn2__mnBrA')); //load mandrill and provide apikey
// //        $this->load->config('Mandrill');
// //        $this->load->library('Mandrill');
// //        $mandrill_ready = NULL;
// //        try {
// //            $this->mandrill->init( $this->CI->config->item('u76rscKU1KeKZn2__mnBrA') );
// //            $mandrill_ready = TRUE;
// //
// //        } catch(Mandrill_Exception $e) {
// //
// //            $mandrill_ready = FALSE;
// //
// //        }
// //
// //        if( $mandrill_ready ) {
// //
// //    //Send us some email!
// //    $email = array(
// //                "html" => "<p>\r\n\tHi Adam,</p>\r\n<p>\r\n\tThanks for <a    href=\"http://mandrill.com\">registering</a>.</p>\r\n<p>etc etc</p>",
// //                "text" => null,
// //                "from_email" => "dannyjimenez110@gmail.com",
// //                "from_name" => "chris french",
// //                "subject" => "Your recent registration",
// //                "to" => array(array("email" => "dannyjimenez110@gmail.com")),
// //                "track_opens" => true,
// //                "track_clicks" => true,
// //                "auto_text" => true
// //            );
// //
// //    $result = $this->mandrill->messages_send($email);
// //    return $result;
// //}
//         $this->load->library('email');
//         $this->email->initialize(array(
//               'protocol' => 'smtp',
//               'smtp_host' => 'smtp.mandrillapp.com',
//               'smtp_user' => 'dannyjimenez110@gmail.com',
//               'smtp_pass' => 'u76rscKU1KeKZn2__mnBrA',
//               'smtp_port' => 587,
//               'mailtype' => 'html',
//               'crlf' => "\r\n",
//               'newline' => "\r\n"
//            ));

// $this->email->from('dannyjimenez110@gmail.com', 'Daniel Jimenez');
// $this->email->to('danny_110@hotmail.com');
// $this->email->subject('Titulo del mensaje');
// //$this->email->message($this->load->view('email_view',TRUE));//Load a view into email body
// $this->email->message("hola este es un mensaje de prueba");//Load a view into email body
// $this->email->send();
// echo $this->email->print_debugger(); //For Debugging Purpose
//     }
}