<?php

class Torneo
{


    private $colObjPartidos;
    private $premio;
    public function __construct( $colObjPartidos, $premio)
    {


        $this->colObjPartidos = $colObjPartidos;
        $this->premio = $premio;
    }

    public function getColObjPartidos()
    {
        return $this->colObjPartidos;
    }

    public function setColObjPartidos($value)
    {
        $this->colObjPartidos = $value;
    }

    public function getPremio()
    {
        return $this->premio;
    }

    public function setPremio($value)
    {
        $this->premio = $value;
    }

    public function ingresarPartido($objEquipo1, $objEquipo2, $fecha, $tipoPartido)
    {
        $colPartidos = $this->getColObjPartidos();
        $objCategoria1 = $objEquipo1->getObjCategoria();
        $objCategoria2 = $objEquipo2->getObjCategoria();
        $idPartido = count($this->getColObjPartidos());
        $partidoNuevo = null;
        if ($objEquipo1->getCantJugadores() === $objEquipo2->getCantJugadores()) {
            if ($objCategoria1->getIdCategoria() === $objCategoria2->getIdCategoria()) {

                if ($tipoPartido === "Futbol") {
                    $partidoNuevo = new Futbol($idPartido, $fecha, $objEquipo1, 0, $objEquipo2, 0, 11, "Monumental");
                } else if ($tipoPartido === "Basquet") {
                    $partidoNuevo = new Basquet($idPartido, $fecha, $objEquipo1, 0, $objEquipo2, 0, 0, null);
                }
            }
            if ($partidoNuevo != null) {
                $colPartidos[] = $partidoNuevo;
            }
            $this->setColObjPartidos($colPartidos);
        }
        return $partidoNuevo;
    }

    public function separarPartidosFutbol($deporte)
    {

        $colPartidos = $this->getColObjPartidos();
        $colPartidosDep = [];
        if ($deporte === "Futbol") {
            foreach ($this->getColObjPartidos() as $partido) {
                if ($deporte === "Futbol" && $partido instanceof Futbol) {
                    $colPartidosDep[] = $partido;
                }
            }
        } else if ($deporte === "Basquet") {
            foreach ($this->getColObjPartidos() as $partido) {
                if ($partido instanceof Basquet) {
                    $colPartidosDep[] = $partido;
                }
            }
        }
        return $colPartidosDep;
    }


    public function darGanadores($deporte)
    {
        $colPartidoDeporte = $this->separarPartidosFutbol($deporte);
        $golesGanador = 0;
        $ganadores = [];
        foreach ($colPartidoDeporte as $partido) {


            if ($partido->getCantGolesE1() > $partido->getCantGolesE2()) {
                if ($golesGanador < $partido->getCantGolesE1()) {
                    $golesGanador = $partido->getCantGolesE1();
                    $ganadores = $partido->darEquipoGanador();
                }

            } else if ($partido->getCantGolesE2() > $partido->getCantGolesE1()) {
                if ($golesGanador < $partido->getCantGolesE2()) {
                    $golesGanador = $partido->getCantGolesE2();
                    $ganadores = $partido->darEquipoGanador();
                }
            } else {
                if ($partido->getCantGolesE1() === $partido->getCantGolesE2()) {
                    if ($golesGanador < $partido->getCantGolesE2()) {
                        $golesGanador = $partido->getCantGolesE2();
                        $ganadores = $partido->darEquipoGanador();
                    } else if ($golesGanador === $partido->getCantGolesE2()) {
                        $ganadores[] = $partido->darEquipoGanador();
                    }
                }

            }

        }
        return $ganadores;
    }

    public function calcularPremioPartido($objPartido)
    { 
        $ganador= "no se encontro partido";
        if($objPartido){
            $coefPartido=$objPartido->coeficientePartido();
            $premioPartido = $coefPartido * $this->getPremio();
            $equipoGanador = $objPartido->darEquipoGanador();

            $ganador=  [
                'equipoGanador' => $equipoGanador,
                'premioPartido' => $premioPartido
            ];
        }
        
        return $ganador;

    }

    public function escribirLista()
    {
        $colProductos = $this->getColObjPartidos();
        $lista = "";
        foreach ($colProductos as $value) {
            $lista .= $value;
        }
        return $lista;
    }


    public function __toString()
    {
        $msj = " Premio:" . $this->getPremio() . "\n";
        $msj .= "Equipos:" . "\n" . $this->escribirLista() . "\n";
        return $msj;

    }
}