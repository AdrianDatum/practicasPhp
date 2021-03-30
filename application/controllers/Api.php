<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function users_get()
    {
        $user = json_decode(
            file_get_contents('http://172.20.0.3:8082/api/users')
        );
         
        $data = $user;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://172.20.0.4:8082/api/users');
        curl_exec($curl);

        $this->response( $data, 200 );
        
        
    }
}
