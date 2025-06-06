<?php
function solveEquation($equation):int{
    $equation = str_replace(' ', '', $equation);
    list($left, $right) = explode('=', $equation);
    $expr = "return ($left) - ($right);";
    $precision = 0.0001;
    $x = 0;
    $step = 1;
    $maxIterations = 1000;
    for ($i = 0; $i < $maxIterations; $i++) {
        $current = eval(str_replace('X', $x, $expr));
        if (abs($current) < $precision) {
            return $x;
        }
        $next = eval(str_replace('X', $x + $precision, $expr));
        $derivative = ($next - $current) / $precision;
        if ($derivative == 0) break;
        $x = $x - $current / $derivative;
    }
    return "Не удалось найти точное решение. Приближенное: $x";
}
echo solveEquation("X * 9 = 56"); // 6.222...
echo solveEquation("X + 5 = 10"); // 5
echo solveEquation("2*X + 3 = X - 5"); // -8
?>