<?php

class Main {

    // массив объектов дерева
    var $arNode = Array();

    // расчет значения с учетом параметров
    public function calc($x, $y, $z){

        if($x){
            foreach ($this->arNode as $obj){
                if($obj->const == "x"){
                    $obj->var = $x;
                    break;
                }
            }
        }

        if($y){
            foreach ($this->arNode as $obj){
                if($obj->const == "y"){
                    $obj->var = $y;
                    break;
                }
            }
        }

        if($z){
            foreach ($this->arNode as $obj){
                if($obj->const == "z"){
                    $obj->var = $z;
                    break;
                }
            }
        }

        foreach ($this->arNode as $obj){
            if(!$obj->parent){
                return $obj->calc();
            }
        }
    }

    // реализация строительства дерева классов
    public function builder ($str) {

        // массив объектов дерева
        $arNode = Array();

        // предварительные операции с входной строкой
        function parse ($str){

            // подготовка входного выражения к парсингу
            $str = mb_strtolower($str, 'UTF-8');
            $str = str_replace(" ", "", $str);
            $n = mb_strlen($str, 'UTF-8');
            $arStr = preg_split('/(?!^)(?=.)/u', $str);

            echo '<pre>';
            echo print_r($arStr);
            echo '</pre>';

            // преобразуем массив символов в массив лексем
            $j=0;
            $accum = $arStr[0];
            for($i=1; $i<$n+1; ++$i){

                if ($i==$n+1){
                    $arLec[$j] = $accum;
                    break;
                }

                if($accum=="-" && $i==1){
                    if(preg_match("/\d/", $arStr[$i])){
                        $accum = $accum.$arStr[$i];
                    }
                    if($arStr[$i]=="("){
                        $arLec[$j] = "0";
                        $arLec[++$j] = "-";
                        ++$j;
                        $accum = $arStr[$i];
                    }
                    continue;
                }

                if($accum=="-" && $arLec[$j-1]=="("){
                    $accum = $accum.$arStr[$i];
                    continue;
                }

                if (preg_match("/^[\d.]/", $accum) && preg_match("/^[\d.]/", $arStr[$i])){
                    $accum = $accum.$arStr[$i];
                }else{
                    $arLec[$j] = $accum;
                    ++$j;
                    $accum = $arStr[$i];
                }
            }
            /*
            $j = 0;
            if($arStr[0]=="-"){
                $accum = $arStr[0];
            }else{
                $accum = $arStr[0];
            }

            for ($i=1; $i<$n+1; ++$i){
                if ($i==$n+1){
                    $arLec[$j] = $accum;
                    continue;
                }
                if (preg_match("/^[\d.]/", $accum)&&preg_match("/^[\d.]/", $arStr[$i])){
                    $accum = $accum.$arStr[$i];
                }else{
                    $arLec[$j] = $accum;
                    ++$j;
                    $accum = $arStr[$i];
                }
            }
             *
             */

            echo '<pre>';
            echo print_r($arLec);
            echo '</pre>';

            return $arLec;
        }

        // построение одного объекта
        function objBuilder($point){

            static $arNumNode = Array(
                "addition" => 1,
                "subtraction" => 1,
                "exponentiation" =>1,
                "multiplication" => 1,
                "division" => 1,
                "number" => 1,
                "constant" => 1);

            switch ($point){

                case "+": $name = "Plus".$arNumNode["addition"];
                    $node = new Plus($name);
                    ++$arNumNode["addition"];
                    break;

                case "-": $name = "Minus".$arNumNode["subtraction"];
                    $node = new Minus($name);
                    ++$arNumNode["subtraction"];
                    break;

                case "*": $name = "Multiply".$arNumNode["multiplication"];
                    $node = new Multiply($name);
                    ++$arNumNode["multiplication"];
                    break;

                case "/": $name = "Fission".$arNumNode["division"];
                    $node = new Fission($name);
                    ++$arNumNode["division"];
                    break;

                case "^": $name = "Exponent".$arNumNode["exponentiation"];
                    $node = new Exponent($name);
                    ++$arNumNode["exponentiation"];
                    break;

                case "x": $name = "Constant".$arNumNode["constant"];
                    $node = new Constant($name);
                    $node->const = "x";
                    $node->var = 0;
                    ++$arNumNode["constant"];
                    break;

                case "y": $name = "Constant".$arNumNode["constant"];
                    $node = new Constant($name);
                    $node->const = "y";
                    $node->var = 0;
                    ++$arNumNode["constant"];
                    break;

                case "z": $name = "Constant".$arNumNode["constant"];
                    $node = new Constant($name);
                    $node->const = "z";
                    $node->var = 0;
                    ++$arNumNode["constant"];
                    break;

                default: $name = "Variable".$arNumNode["number"];
                    $node = new Variable($name);
                    $node->var = $point;
                    ++$arNumNode["number"];
            }
            return $node;
        }

        // строительство тройки объектов дерева
        function trioBuilder($topLec, $leftLec, $rightLec, $topP, $leftP, $rightP, $topObj){

            // вершина тройки
            if(!$topObj){
                $topTrio = objBuilder($topP);
                $topTrio->lec = $topLec;
            }  else {
                $topTrio = $topObj;
            }

            // левая ветвь тройки
            $leftTrio = objBuilder($leftP);
            $leftTrio->lec = $leftLec;

            // правая ветвь тройки
            $rightTrio = objBuilder($rightP);
            $rightTrio->lec = $rightLec;

            // формирование тройки из объектов
            $topTrio->childrenLeft = $leftTrio;
            $topTrio->childrenRight = $rightTrio;
            $leftTrio->parent = $topTrio;
            $rightTrio->parent = $topTrio;
            if(!$topObj){
                $trio = Array($topTrio, $leftTrio, $rightTrio);
                return $trio;
            }  else {
                $duo = Array($leftTrio, $rightTrio);
                return $duo;
            }
        }

        // проверка на полное построение дерева
        function stopBuild($arNode){
            foreach ($arNode as $obj){
                if($obj->lec[1] && !$obj->childrenLeft && !$obj->childrenRight){
                    return FALSE;
                }
            }
            return TRUE;
        }

        // поиск вершины для следующей тройки
        function searchObj($arNode){
            foreach ($arNode as $obj){
                if($obj->lec[1] && !$obj->childrenLeft && !$obj->childrenRight){
                    return $obj;
                }
            }
        }

        // определение точки перегиба выражения
        function inflPoint($lec){
            $infl=0;
            $max=0;
            static $br = 0;
            static $arPrioritet = Array(
                "+" => 3,
                "-" => 3,
                "*" => 2,
                "/" => 2,
                "^" => 1);

            foreach ($lec as $key=>$value){
                if(preg_match("/^[\d.]/", $value)){
                    continue;
                }
                if($value=="("){
                    ++$br;
                    continue;
                }
                if($value==")"){
                    --$br;
                    continue;
                }
                if($arPrioritet[$value]-3*$br >= $max){
                    $max=$arPrioritet[$value]-3*$br;
                    $infl=$key;
                }
            }
            return $infl;
        }

        $arLec = parse($str);

        // первая тройка дерева
        $topN = inflPoint($arLec);
        $topP = $arLec[$topN];
        $leftLec = array_slice($arLec, 0, $topN);
        if($leftLec[0]=="(" && $leftLec[count($leftLec)-1]==")"){
            array_shift($leftLec);
            array_pop($leftLec);
        }
        $rightLec = array_slice($arLec, $topN+1);
        if($rightLec[0]=="(" && $rightLec[count($rightLec)-1]==")"){
            array_shift($rightLec);
            array_pop($rightLec);
        }
        $leftN = inflPoint($leftLec);
        $leftP = $leftLec[$leftN];
        $rightN = inflPoint($rightLec);
        $rightP = $rightLec[$rightN];
        $trio = trioBuilder($arLec, $leftLec, $rightLec, $topP, $leftP, $rightP, NULL);
        $arNode = $trio;

        // все последующие тройки дерева
        while (!stopBuild($arNode)){
            $topTrio = searchObj($arNode);
            $arLec = $topTrio->lec;
            $topN = inflPoint($arLec);
            $leftLec = array_slice($arLec, 0, $topN);
            if($leftLec[0]=="(" && $leftLec[count($leftLec)-1]==")"){
                array_shift($leftLec);
                array_pop($leftLec);
            }
            $rightLec = array_slice($arLec, $topN+1);
            if($rightLec[0]=="(" && $rightLec[count($rightLec)-1]==")"){
                array_shift($rightLec);
                array_pop($rightLec);
            }
            $leftN = inflPoint($leftLec);
            $leftP = $leftLec[$leftN];
            $rightN = inflPoint($rightLec);
            $rightP = $rightLec[$rightN];
            $duo = trioBuilder(NULL, $leftLec, $rightLec, NULL, $leftP, $rightP, $topTrio);
            $arNode = array_merge($arNode, $duo);
        }
        $this->arNode = $arNode;
    }
}

abstract class Term {

    public $name;
    public $childrenLeft;
    public $childrenRight;
    public $parent;
    public $lec;
    public $const;
    public $var;

    public function __construct($name) {
        $this->name = $name;
    }

    abstract function calc();
}

class Plus extends Term {
    public function calc() {
        return $this->childrenLeft->calc()+$this->childrenRight->calc();
    }
}

class Minus extends Term {
    public function calc() {
        return $this->childrenLeft->calc()-$this->childrenRight->calc();
    }
}

class Multiply extends Term {
    public function calc() {
        return $this->childrenLeft->calc()*$this->childrenRight->calc();
    }
}

class Fission extends Term {
    public function calc() {
        return $this->childrenLeft->calc()/$this->childrenRight->calc();
    }
}

class Exponent extends Term {
    public function calc() {
        return pow ($this->childrenLeft->calc(), $this->childrenRight->calc());
    }
}

class Constant extends Term {
    public function calc() {
        return $this->var;
    }
}

class Variable extends Term {
    public function calc() {
        return $this->var;
    }
}

// задаем исходное математическое выражение
$str = "(x+10.2)^2+5*y-z";
$x = 2;
$y = 1;
$z = 3;

$parse = new Main();

// строительство дерева классов
$parse->builder($str);

//echo '<pre>';
//echo print_r($parse->arNode);
//echo '</pre>';


echo $str." = ".$parse->calc($x, $y, $z);

echo " при: x=".$x."; y=".$y."; z=".$z;