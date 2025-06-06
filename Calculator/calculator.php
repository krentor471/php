<?php
header('Content-Type: text/plain');

function validateExpression($expression) {
    $expression = str_replace(' ', '', $expression);
    
    if (!preg_match('/^[0-9+\\-*\/()]+$/', $expression)) {
        return false;
    }
    
    $count = 0;
    for ($i = 0; $i < strlen($expression); $i++) {
        if ($expression[$i] === '(') $count++;
        if ($expression[$i] === ')') $count--;
        if ($count < 0) return false;
    }
    return $count === 0;
}

function calculate($expression) {
    $expression = str_replace(' ', '', $expression);
    
    if (empty($expression)) return 0;
    
    if (is_numeric($expression)) return floatval($expression);
    
    $count = 0;
    $start = -1;
    for ($i = 0; $i < strlen($expression); $i++) {
        if ($expression[$i] === '(') {
            if ($count === 0) $start = $i;
            $count++;
        }
        if ($expression[$i] === ')') {
            $count--;
            if ($count === 0) {
                $subExpression = substr($expression, $start + 1, $i - $start - 1);
                $result = calculate($subExpression);
                $expression = substr($expression, 0, $start) . $result . substr($expression, $i + 1);
                $i = $start + strlen($result) - 1;
            }
        }
    }
    
    $operators = ['*', '/'];
    foreach ($operators as $operator) {
        $parts = explode($operator, $expression);
        if (count($parts) > 1) {
            $result = calculate($parts[0]);
            for ($i = 1; $i < count($parts); $i++) {
                $next = calculate($parts[$i]);
                if ($operator === '*') {
                    $result *= $next;
                } else {
                    if ($next === 0) {
                        return "Error: Division by zero";
                    }
                    $result /= $next;
                }
            }
            return $result;
        }
    }
    
    $operators = ['+', '-'];
    foreach ($operators as $operator) {
        $parts = explode($operator, $expression);
        if (count($parts) > 1) {
            $result = calculate($parts[0]);
            for ($i = 1; $i < count($parts); $i++) {
                $next = calculate($parts[$i]);
                if ($operator === '+') {
                    $result += $next;
                } else {
                    $result -= $next;
                }
            }
            return $result;
        }
    }
    
    return floatval($expression);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['expression'])) {
        $expression = $_POST['expression'];
        
        if (validateExpression($expression)) {
            $result = calculate($expression);
            echo $result;
        } else {
            echo 'Invalid expression';
        }
    } else {
        echo 'No expression provided';
    }
}
?> 