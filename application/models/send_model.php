<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Send_Model extends CI_Model{

    public function __construct() {
        parent::__construct();
    }

    public function send_email($email_from, $name_from = '' , $array_email_to, $title, $menssage, $url_file=''){
    	
        $this->load->library('mandrill'); //load mandrill and provide apikey
        if(is_string($array_email_to)){
            $arr_mail = explode(',', $array_email_to);
            $array_email_to = array();
            foreach ($arr_mail as $key => $value) {
                $array_email_to[$key] = array(
                                            'email' => $value,
                                            'name' => '',
                                            'type' => 'to'
                                    ); 
                      
            }    
        }
        if(is_array($array_email_to[0])){
            ///si se cumple esta condicion quiere deecir que lo correos a enviar estan dentro de un arreglo de arreglos
        }else if(is_array($array_email_to)){
            //$array_email_to = array();
            foreach ($array_email_to as $key => $value) {
                $array_email_to[$key] = array(
                                            'email' => $value,
                                            'name' => '',
                                            'type' => 'to'
                                    ); 
                      
            }  
        }
        If(!empty($url_file)){
            //$attachment = file_get_contents($url_file[0].$url_file[1].'.pdf');              
            $attachment = file_get_contents($url_file[0]);              
            $attachment_encoded = base64_encode($attachment);
            $name_file = $url_file[1].'.pdf';
        }else{
            $attachment_encoded = '';
            $name_file = '';
        }
        
        try {
            $mandrill = new Mandrill('Ae4hZndzZDl6DECj6yj77w');
            $message = array(
                'html' => $menssage,
                'text' => '',
                'subject' => $title,
                'from_email' => $email_from,
                'from_name' => $name_from,
//                'to' => array(
//                    array(
//                        'email' => $email_to,
//                        'name' => '',
//                        'type' => 'to'
//                    )
//                ),
                'to' => $array_email_to,
                'headers' => array('Reply-To' => ''),
                'important' => TRUE,
        //        'track_opens' => true,
        //        'track_clicks' => true,
        //        'auto_text' => null,
        //        'auto_html' => null,
                'inline_css' => true,//se presentan los estilos en los mensajes tipo html que pesen menos de 256 kb
        //        'url_strip_qs' => null,
                'preserve_recipients' => true,//pone en el encabezado a todos los correos que reciben
        //        'view_content_link' => null,
        //        'bcc_address' => 'masterpc@masterpc.com.ec',//correo que se desee que reciba una copia de todos los mensajes
       //         'tracking_domain' => 'masterpc.com.ec',//domino personalizado para seguimientpo de los correos
        //        'signing_domain' => null,
        //        'return_path_domain' => null,
        //        'merge' => true,
                'merge_language' => 'mailchimp',
        //        'global_merge_vars' => array(
        //            array(
        //                'name' => 'merge1',
        //                'content' => 'merge1 content'
        //            )
        //        ),
        //        'merge_vars' => array(
        //            array(
        //                'rcpt' => 'recipient.email@example.com',
        //                'vars' => array(
        //                    array(
        //                        'name' => 'merge2',
        //                        'content' => 'merge2 content'
        //                    )
        //                )
        //            )
        //        ),
        //        'tags' => array('password-resets'),
        //        'subaccount' => 'customer-123',
        //        'google_analytics_domains' => array('example.com'),
        //        'google_analytics_campaign' => 'message.from_email@example.com',
        //        'metadata' => array('website' => 'www.example.com'),
        //        'recipient_metadata' => array(
        //            array(
        //                'rcpt' => 'dannyjimenez110@example.com',
        //                //'values' => array('user_id' => 123456)
        //            )
        //        ),
                'attachments' => array(///adicionar archivos 
                    array(
                        //'path' => base_url('resources/cotizacionespdf'),
                        'type' => 'application/pdf',
                        'name' => $name_file,
                        'content' => $attachment_encoded
                    )
                ),
        //        'images' => array(///adicionar imagenes
        //            array(
        //                'type' => 'image/png',
        //                'name' => 'IMAGECID',
        //                'content' => 'ZXhhbXBsZSBmaWxl'
        //            )
        //        )
            );
            $async = false;
            $ip_pool = '';

            //$send_at = date('Y-m-d h:m:s', time());
            $send_at = '';
        //    $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
            $result = $mandrill->messages->send($message, $async ,$ip_pool,$send_at);
            //print_r($result);
            //if($result[0]['status'] == 'sent'){
                return $result;
//            }else{
//                return NULL;
//            }

        } catch(Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
    }
    
}