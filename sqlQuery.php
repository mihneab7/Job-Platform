<?php

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