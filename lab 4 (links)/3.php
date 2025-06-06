<?php
$rulers = [
    'XVI' => 'Иван Васильевич',
    'XVIII' => 'Пётр Алексеевич', 
    'XIX' => 'Николай Павлович'
];

$century = "XVI";
if (isset($rulers[$century])) {
    echo "В $century веке царствовал " . $rulers[$century];
} else {
    echo "Для $century века нет данных о правителе";
}
?>