<?php

class Job
{
    private $titlu;
    private $descriere;
    private $judet;
    private $oras;
    private $valabilitate;
    private $status;
    private $tags;

    public function __construct($titlu, $descriere, $judet, $oras,
                                $valabilitate, $status, $tags)
    {
        $this->titlu = $titlu;
        $this->descriere = $descriere;
        $this->judet = $judet;
        $this->oras = $oras;
        $this->valabilitate = $valabilitate;
        $this->status = $status;
        $this->tags = $tags;

        echo "Built instance\n";
    }

    public function __destruct()
    {
        echo "Destroyed instance\n";
    }

    public function setTitlu($value)
    {
        $this->titlu = $value;
    }

    public function setDescriere($value)
    {
        $this->descriere = $value;
    }

    public function setJudet($value)
    {
        $this->judet = $value;
    }

    public function setOras($value)
    {
        $this->oras = $value;
    }

    public function setValabilitate($value)
    {
        $this->valabilitate = $value;
    }

    public function setStatus($value)
    {
        $this->status = $value;
    }

    public function setTags($value)
    {
        $this->tags = $value;
    }

    public function getAttribute($string)
    {
        switch ($string) {
            case 'titlu':
                return $this->titlu;

            case 'descriere':
                return $this->descriere;

            case 'judet':
                return $this->judet;

            case 'oras':
                return $this->oras;

            case 'valabilitate':
                return $this->valabilitate;

            case 'status':
                return $this->status;

            case 'tags':
                return $this->tags;
        }
    }

    public function getTitlu()
    {
        return $this->titlu;
    }

    public function getDescriere()
    {
        return $this->descriere;
    }

    public function getJudet()
    {
        return $this->judet;
    }

    public function getOras()
    {
        return $this->oras;
    }

    public function getValabilitate()
    {
        return $this->valabilitate;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getTags()
    {
        return $this->tags;
    }
}