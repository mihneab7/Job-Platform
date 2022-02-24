<?php

class ConnectDB
{
    private static $instance = null;
    private $conn;

    private $host = '127.0.0.1';
    private $user = 'root';
    private $password = 'Flanco2021';
    private $name = 'hr';

    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host}; dbname={$this->name}",
                        $this->user, $this->password,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ConnectDB();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

class sqlQuery
{
    private $sqlQuery = '';

    private $action;
    private $target;
    private $isAlias;
    private $alias;
    private $table;
    private $isCondition;
    private $condition;
    private $isOrder;
    private $order;
    private $orderType;
    private $insertValues;

    public function __construct($action, $target, $isAlias = false, $alias = '', $table,
                                $isCondition = false, $condition = '', $isOrder = false, $order = '',
                                $orderType = '', $insertValues)
    {
        $this->action = $action;
        $this->target = $target;
        $this->isAlias = $isAlias;
        $this->alias = $alias;
        $this->table = $table;
        $this->isCondition = $isCondition;
        $this->condition = $condition;
        $this->isOrder = $isOrder;
        $this->order = $order;
        $this->orderType = $orderType;
        $this->insertValues = $insertValues;

        /*
        clasa sqlQuery nu am scris-o bine, a trebuit sa ii fac multe modificari
        in momentul in care o implementam in restul codului si inca are buguri. ma gandesc sa o sterg.

        cateva explicatii despre ce reprezinta atributele:
        - $action indica actiunea pe care vrem sa o facem (SELECT, INSERT, UPDATE, DELETE)
        - $target spune ce vrem sa modificam (*, nume, prenume etc.)
        - $isAlias ne spune daca vreun camp va avea alias
        - $alias este aliasul propriu-zis
        - $table reprezinta tabelul pe care lucram
        - $isCondition ne spune daca folosim vreo conditie (WHERE)
        - $condition este conditia propriu-zisa
        - $isOrder ne spune daca se face vreo ordonare (ORDER BY)
        - $order reprezinta tipul de ordonare
        - $insertValue reprezinta datele ce vor fi inserate in tabel
        */
    }

    public function buildQuery()
    {
        $targetCopy = $this->target;
        
        if (is_array($this->target)) {
            $targetList = '';
            $lengthTarget = count($this->target);

            if ($this->isAlias && isset($this->alias)) {
                for ($i = 0; $i < $lengthTarget; $i++) {
                    $targetCopy[$i] .= ' AS "' . $this->alias[$i] . '"';
                }
            }

            for ($i = 0; $i < $lengthTarget; $i++) {
                $targetList .= $targetCopy[$i] . ', ';
            }

            $targetList = substr($targetList, 0, -2);
        } else {
            $targetList = $this->target;
            if ($this->isAlias && isset($this->alias)){
                $targetList = $this->target . ' AS "' . $this->alias . '"';
            }
        }

        if (is_array($this->insertValues)) {
            $insertList = '';
            $lengthInsert = count($this->insertValues);
            for ($i = 0; $i < $lengthInsert; $i++) {
                $insertList .= '"' . $this->insertValues[$i] . '", ';
            }
            $insertList = substr($insertList, 0, -2);
        } else {
            $insertList = $this->insertValues;
        }

        if (is_array($this->condition)) {
            $lengthCondition = count($this->condition);
            $conditionList = '';
            for ($i = 0; $i < $lengthCondition - 1; $i++) {
                $conditionList .= $this->condition[$i] . ', ';
            }
            $conditionList = substr($conditionList, 0, -2);
            $lastCondition = end($this->condition);
        }

        switch ($this->action) {
            case 'SELECT':
                $this->sqlQuery .= 'SELECT ' . $targetList . ' FROM ' . $this->table;

                if ($this->isCondition && isset($this->condition)) {
                    $this->sqlQuery .= ' WHERE ' . $this->condition;
                }

                if ($this->isOrder && isset($this->order)) {
                    $this->sqlQuery .= ' ORDER BY ' . $this->order . ' ' . $this->orderType;
                }

                break;

            case 'INSERT':
                $this->sqlQuery .= 'INSERT INTO ' . $this->table . ' (' . $targetList . ') VALUES (' . $insertList . ')';
                break;

            case 'UPDATE':
                $this->sqlQuery .= 'UPDATE ' . $this->table . ' SET ' . $conditionList . ' WHERE ' . $lastCondition;
                break;
                
            case 'DELETE':
                $this->sqlQuery .= 'DELETE FROM ' . $this->table . ' WHERE ' . $this->condition;
                break;
        }
    }

    public function setQueryParameter($string, $value)
    {
        switch ($string) {
            case 'action':
                $this->action = $value;
                break;

            case 'target':
                $this->target = $value;
                break;

            case 'isalias':
                $this->isAlias = $value;
                break;

            case 'alias':
                $this->alias = $value;
                break;

            case 'table':
                $this->table = $value;
                break;

            case 'iscondition':
                $this->isCondition = $value;
                break;

            case 'condition':
                $this->condition = $value;
                break;

            case 'isorder':
                $this->isOrder = $value;
                break;

            case 'order':
                $this->order = $value;
                break;

            case 'ordertype':
                $this->orderType = $value;
                break;

            case 'insertvalues':
                $this->insertValues = $value;
                break;
        }
    }

    public function getQueryParameter($string)
    {
        switch ($string) {
            case 'action':
                return $this->action;

            case 'target':
                return $this->target;

            case 'isalias':
                return $this->isAlias;

            case 'alias':
                return $this->alias;

            case 'table':
                return $this->table;

            case 'iscondition':
                return $this->isCondition;

            case 'condition':
                return $this->condition;

            case 'isorder':
                return $this->isOrder;

            case 'order':
                return $this->order;

            case 'ordertype':
                return $this->orderType;

            case 'insertvalues':
                return $this->insertValues;
        }
    }

    public function getQuery()
    {
        return $this->sqlQuery;
    }

    public function printQuery()
    {
        print($this->sqlQuery);
    }
}

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