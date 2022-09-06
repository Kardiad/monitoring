<?php

namespace Controllers;

class Monitoring extends Basecontroller {

    public function __construct($route) {

        $this->$route();
        
    }

    public function monitoring() {

        $data = [
            'currentPage' => 'monitoring'
        ];

        $this->generarDiscos();
        $this->generarDatos();
        $this->numeroProblemas();
        $this->graficaServicios();

        template('page-main-content/monitoring', $data);

    }

    public function graficaServicios(){
        if(isset($_GET['datos']) && $_GET['datos']==5){
            $array = [];
            for($x=0; $x<7; $x++){
                array_push($array, ['pingmin'=>random_int(1, 1000), 'pingmax'=>random_int(1, 1000)]);
            }
            echo json_encode($array);
        }
    }

    public function generarDiscos() {        
        if(isset($_GET['datos']) && $_GET['datos']==1) {
        $array = [];
        for($i=0; $i<7; $i++){
            $percent = random_int(-1, 100);
            $array['percent'] = $percent;
            if($percent>=0 && $percent<50){
                $array['color'] = '#198754';
            }else if($percent>=50 && $percent<80){
                $array['color'] = '#ffc107';
            }else if($percent>=80){
                $array['color'] = '#dc3545';
            }else{
                $array['color'] = '#6c757d';
            }
        }
            echo json_encode($array);
        }
    }

    public function numeroProblemas(){
        if(isset($_GET['datos']) && $_GET['datos']==4){
            $contadorProblemas = [];
            for($x=0; $x<8; $x++){
                $cantidadKO = random_int(1, 10);
                $cantidadWR = random_int(1, 10);
                $cantidadCR = random_int(1, 10);
                array_push($contadorProblemas, ['KO'=>$cantidadKO, 'WR'=>$cantidadWR, 'CR'=>$cantidadCR]);
            }
            echo json_encode($contadorProblemas);
        }
    }

    public function generarDatos(){
        if(isset($_GET['datos']) && $_GET['datos']==2){
            $alertas = [];
            $servicios = [];
            $graficos = [];
            $ventanaServidor = [];
            $cantidadServicios = random_int(1, 10);
            $cantidadAlertas = random_int(1, 10);
            for($x=0; $x<$cantidadServicios; $x++){
                array_push($alertas, ['descripcion'=>$this->palabras(), 'status'=>$this->status(), 'tiempo'=>rand(1,1000).'h']);
            }
            for($x=0; $x<$cantidadAlertas; $x++){
                array_push($servicios, ['nombre'=>$this->palabras(), 'descripcion'=>$this->palabras(), 'status'=>$this->status()]);
            }
            $graficos['usado'] = random_int(0, 100);
            $graficos['libre'] = 100 - $graficos['usado'];
            $ventanaServidor = ['alertas'=>$alertas, 'servicios'=>$servicios, 'graficos'=> $graficos];
            echo json_encode($ventanaServidor);
        }
    }

    private function palabras(){
        $length = rand(1, 10);
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    }

    private function status(){
        switch(rand(1,3)){
            case 1:
                return 'KO';
                break;
            case 2:
                return 'WR';
                break;
            default:
                return 'CR';
            break;
        }
    }

}