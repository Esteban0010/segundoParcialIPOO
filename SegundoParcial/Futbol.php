<?php

class Futbol extends Partido{
private $capacidadCancha;
private $nombreCancha;


public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2,$capacidadCancha, $nombreCancha) {
    parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
    $this->capacidadCancha = $capacidadCancha;
    $this->nombreCancha = $nombreCancha;
}

public function getCapacidadCancha() {
    return $this->capacidadCancha;
}

public function setCapacidadCancha($value) {
    $this->capacidadCancha = $value;
}

public function getNombreCancha() {
    return $this->nombreCancha;
}

public function setNombreCancha($value) {
    $this->nombreCancha = $value;
}

    public function coeficientePartido(){
        $coef = parent::coeficientePartido();
        $objCategoria = $this->getObjEquipo1()->getObjCategoria();
        $categoria= $objCategoria->getDescripcion();
        if($categoria === "Coef_Menores"){
            $coef=$coef* 0.13;
        }else if($categoria === "Coef_juveniles"){
            $coef=$coef*0.19;
        }else{
            $coef=$coef*0.27;
        }

        return $coef;
    }
    public function __toString(){
        $msj=parent::__toString();
        $msj.="Capacidad Cancha :".$this->getCapacidadCancha() ."\n";
        $msj.="Nombre Cancha:".$this->getNombreCancha() ."\n";
        return $msj;

    }

}