# MailingWS
Webservices para mailing

#Ejemplo para consumir un servicio rest por post
Aqui se muestra un ejemplo de los datos que un cliente debe pasar por post al servidor
y consumir del servicio.

    /*primera forma de enviar los parametros de los correos como arreglo de arreglos*/
        $correos = array(
                        array(
                            'email' => 'example1@example.com',
                            'name' => 'example name1',//opcional
                            'type' => 'to'
                        ),
                        array(
                            'email' => 'example2@example.com',
                            'name' => 'example name2',//opcinal
                            'type' => 'to'
                        )                   
         );

       /*segunda forma de enviar correos como un string separados por comas*/
            $correos = 'example2@example.com,example2@example.com';
        /*tercera forma enviar un arreglo de correos*/
            $correos = array('example1@example.com','example2@example.com');

        $url = base_url().'send_mail/send';
        $data = array('email_from' => 'example_from@example.com',
                    'name_from' => 'Name example from',
                    'email_to' => $correos,
                    'title' => 'Titulo del mensaje',
                    'msg' => 'cuerpo del correo',
                    'url_file' => array($url_file,$name_file)
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
        echo $result;

#Configuracion en el hosting de los correos, para que sean validados por mandrill
Para todos los dominios registrados en mandrill se crea un DKIM y un SPF los mismos que deben ser configurados el el hosting 
del dominio.
1.- En éste enlace https://mandrillapp.com/settings/sending-domains podemos ver los dominios registrados por mandrill, en el mismo 
podemos ver las instrucciones de DKIM y SPF que deben ser configuradas en el cpanel del hosting, se debe crear un registro TXT en el editor de
zona DNS avanzada, primeramente se selecciona el dominio a configurar y se crea el nuevo registro con los datos que se proporciona 
en mandrill 

para mejor comprension ver el siguiente video https://www.youtube.com/watch?v=0MniuOXwPJc