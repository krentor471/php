<?php
$equation = "X * 9 = 56";

$parts = explode('=', $equation);
$leftPart = trim($parts[0]);
$rightPart = trim($parts[1]);

$operators = ['*', '/', '+', '-'];
$operator = '';
foreach ($operators as $op) {
    if (strpos($leftPart, $op) !== false) {
        $operator = $op;
        break;
    }
}

if (empty($operator)) {
    die("Неизвестный оператор в уравнении");
}

$operands = explode($operator, $leftPart);
$xSide = trim($operands[0]);
$numSide = trim($operands[1]);

$rightNum = (float)$rightPart;
$num = (float)$numSide;

if ($xSide == 'X') {
    switch ($operator) {
        case '*':
            $x = $rightNum / $num;
            break;
        case '/':
            $x = $rightNum * $num;
            break;
        case '+':
            $x = $rightNum - $num;
            break;
        case '-':
            $x = $rightNum + $num;
            break;
    }
} else {
    switch ($operator) {
        case '*':
            $x = $rightNum / (float)$xSide;
            break;
        case '/':
            $x = (float)$xSide / $rightNum;
            break;
        case '+':
            $x = $rightNum - (float)$xSide;
            break;
        case '-':
            $x = (float)$xSide - $rightNum;
            break;
    }
}

echo "Решение уравнения $equation: X = " . round($x, 2);
?>