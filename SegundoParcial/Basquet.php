<?php

class Basquet extends Partido
{

   private $cantInfracciones;
   private $coefPenalizacion;


	public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2,$cantInfracciones, $coefPenalizacion) {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
		$this->cantInfracciones = $cantInfracciones;
		$this->coefPenalizacion = $coefPenalizacion;
	}

	public function getCantInfracciones() {
		return $this->cantInfracciones;
	}

	public function setCantInfracciones($value) {
		$this->cantInfracciones = $value;
	}

	public function getCoefPenalizacion() {
		return $this->coefPenalizacion;
	}

	public function setCoefPenalizacion($value) {
		$this->coefPenalizacion = $value;
	}

    public function coeficientePartido(){
        $coef = parent::coeficientePartido();
        $coefPenalizacion= $this->getCoefPenalizacion()??0.75;
        $coef = $coef-($coefPenalizacion*$this->getCantInfracciones());
        return $coef;
    }

    public function __toString(){

        $msj= parent::__toString();
        $msj.="Cantidad Infracciones:".$this->getCantInfracciones() ."\n";
        $msj.=" Coef penalizacion:".$this->getCoefPenalizacion() ."\n";
        return $msj;

    }
}