<?php
class Batalla {
    // propiedades
    public $luchador1;
    public $luchador2;
    public $puntosluchador1;
    public $puntosluchador2;
    public $saltaTurno1;
    public $saltaTurno2;

    // constructor
    public function __construct($luchador1, $luchador2) {
        $this->luchador1 = $luchador1;
        $this->luchador2 = $luchador2;
        $this->puntosluchador1 = 100;
        $this->puntosluchador2 = 100;
        $this->saltaTurno1 = false;
        $this->saltaTurno2 = false;
    }

    // métodos
    public function atacar($atacante) {
        if ($atacante === $this->luchador1) {
            if ($this->saltaTurno1) {
                echo "$this->luchador1 pierde el turno .\n";
                $this->saltaTurno1 = false;
                return;
            }
           
            $daño = rand(10, 100);
            if (rand(1, 100) <= 20) {
                echo "$this->luchador2 esquiva el ataque de $this->luchador1.\n";
            } else {
                $this->puntosluchador2 -= $daño;
                echo "$this->luchador1 ataca a $this->luchador2 y causa $daño de daño. Vida $this->luchador2: $this->puntosluchador2\n";
                if ($daño == 100) {
                    $this->saltaTurno2 = true;
                    echo " $this->luchador2 pierde su  turno.\n";
                }
            }
        } else {
            if ($this->saltaTurno2) {
                echo "$this->luchador2 pierde turno.\n";
                $this->saltaTurno2 = false;
                return;
            }
    
            $daño = rand(10, 120);
            if (rand(1, 100) <= 25) {
                echo "$this->luchador1 esquiva el ataque de $this->luchador2.\n";
            } else {
                $this->puntosluchador1 -= $daño;
                echo "$this->luchador2 ataca a $this->luchador1 y causa $daño de daño. Vida $this->luchador1: $this->puntosluchador1\n";
                if ($daño == 120) {
                    $this->saltaTurno1 = true;
                    echo "$this->luchador1 pierde su próximo turno.\n";
                }
            }
        }
    }


    public function resultado() {
        if ($this->puntosluchador1 <= 0 && $this->puntosluchador2 <= 0) {
            echo "Es un empate\n";
        } else if ($this->puntosluchador1 <= 0) {
            echo " $this->luchador2 gana .\n";
        } else if ($this->puntosluchador2 <= 0) {
            echo " $this->luchador1 gana .\n";
        }
    }
}

// OBJETO
$batalla = new Batalla("Deadpool", "Wolverine");
$turno = 1;
while ($batalla->puntosluchador1 > 0 && $batalla->puntosluchador2 > 0) {
    echo "Ataque $turno\n";
    $batalla->atacar("Deadpool");
    if ($batalla->puntosluchador2 <= 0) break;
    $batalla->atacar("Wolverine");
    if ($batalla->puntosluchador1 <= 0) break;
    $turno++;
}
    $batalla->resultado();
