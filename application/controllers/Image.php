<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Image extends RestController {

    function __construct()
    {
        parent::__construct();
    }

    public function editImage_get(){

        $atributos = array(
            "apellidos" => "CASTRO HERNANDEZ",
            "nombres" => "DAVID ERNESTO",
            "dui" => "03647905-9",
            "genero" => "M"
        );

        $image = imagecreatefrompng(__DIR__ . "/" . 'DUI.png');
        $color = imagecolorallocate($image, 0, 0, 0);
        $font_path = __DIR__ . "/" . "tablaksh.ttf";

        foreach($atributos as $key => $value){
            $coordenadas = $this->getCoordenadas($key);
            imagettftext($image, 15, 0, $coordenadas[0], $coordenadas[1], $color, $font_path, $value);

        }
        
        ob_start(); 

        
        // header('Content-type: image/png');
        // imagepng($image); 
        
        // imagedestroy($image);
        imagepng($image);
        $image_data = ob_get_contents (); 

        ob_end_clean (); 

        $image_data_base64 = base64_encode ($image_data);
        
        echo '<img src="data:image/png;base64,' . $image_data_base64.'"/>';
        echo '<textarea cols="140" rows="15">'.$image_data_base64.'</textarea>';
        
        
    }

    private function getCoordenadas($atributo){
        switch($atributo){
            case "apellidos": 
                return array(235,127);
                break;
            case "nombres": 
                return array(235, 160);
                break;
            case "dui": 
                return array(100, 400);
            case "genero": 
                return array(255, 218);
            default: 
                return false;
        }
    }

    

}