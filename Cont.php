<?php

class Cont
{
    private $nume;
    private $prenume;
    private $email;
    private $parola;
    private $status;
    private $rol_id;

    public function __construct($nume, $prenume, $email, $parola, $rol_id)
    {
        $this->nume = $nume;
        $this->prenume = $prenume;
        $this->email = $email;
        $this->parola = $parola;
        $this->status = 0;
        $this->rol_id = $rol_id;

        echo "Built instance\n";
    }

    public function __destruct()
    {
        echo "Destroyed instance\n";
    }

    public function setNume($value)
    {
        if (!is_string($value)) {
            echo 'Noua valoare nu este string!';
            return;
        }
        $this->nume = $value;
    }

    public function setPrenume($value)
    {
        if (!is_string($value)) {
            echo 'Noua valoare nu este string!';
            return;
        }
        $this->prenume = $value;
    }

    public function setEmail($value)
    {
        if (!is_string($value)) {
            echo 'Noua valoare nu este string!';
            return;
        }
        $this->email = $value;
    }

    public function setParola($value)
    {
        if (!is_string($value)) {
            echo 'Noua valoare nu este string!';
            return;
        }
        $this->parola = $value;
    }

    public function setStatus($value)
    {
        if (!is_numeric($value)) {
            echo 'Noua valoare nu este numerica!';
            return;
        }
        $this->status = $value;
    }

    public function setRolID($value)
    {
        if (!is_numeric($value)) {
            echo 'Noua valoare nu este numerica!';
            return;
        }
        $this->rol_id = $value;
    }

    public function getNume()
    {
        return $this->nume;
    }

    public function getPrenume()
    {
        return $this->prenume;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getParola()
    {
        return $this->parola;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRolID()
    {
        return $this->rol_id;
    }
}