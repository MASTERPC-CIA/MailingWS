<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Client_Send extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }

    public function enviar(){
        /*primera forma de enviar los parametros de los correos como arreglo de arreglos*/
//        $correos = array(
//                        array(
//                            'email' => 'danny_110@hotmail.com',
//                            'name' => 'Danny',//opcional
//                            'type' => 'to'
//                        ),
//                        array(
//                            'email' => 'mariuxikate@gmail.com',
//                            'name' => 'Mary',//opcinal
//                            'type' => 'to'
//                        )
//                    );
//                    print_r($correos);
       /*segunda forma de enciar correos como un string separados por comas*/
        //    $correos = 'danny_110@hotmail.com';
        /*tercera forma enviar un arreglo de correos*/
         //   $correos = array('danny_110@hotmail.com','mariuxikate@gmail.com');
           
        $url = base_url().'send_mail/send';
        $data = array('email_from' => 'dannyjimenez110@gmail.com',
                    'name_from' => 'Daniel Jimenez hotmail',
                    //'email_to' => 'danny_110@hotmail.com',
                    'email_to' => $correos,
                    'title' => 'Titulo del mensaje',
                    'msg' => 'cuerpo del mensaje'
            );

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
//        $json_a = json_decode($result,true); 
//        print_r($json_a);
        echo $result;
    
    }
}
