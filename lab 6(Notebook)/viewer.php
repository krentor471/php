<?php
require_once 'db.php';

function getContacts($sort = 'default', $page = 1) {
    global $pdo;
    
    $per_page = 10;
    $offset = ($page - 1) * $per_page;
    
    $count_query = "SELECT COUNT(*) FROM contacts";
    $total_records = $pdo->query($count_query)->fetchColumn();
    $total_pages = ceil($total_records / $per_page);
    
    $order_by = match($sort) {
        'surname' => 'surname ASC, name ASC',
        'birthdate' => 'birthdate ASC',
        default => 'id ASC'
    };
    
    $query = "SELECT * FROM contacts ORDER BY $order_by LIMIT $per_page OFFSET $offset";
    $stmt = $pdo->query($query);
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '<table class="contacts-table">';
    $html .= '<tr><th>ФИО</th><th>Пол</th><th>Дата рождения</th><th>Телефон</th><th>Адрес</th><th>Email</th><th>Комментарий</th></tr>';
    
    foreach ($contacts as $contact) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($contact['surname'] . ' ' . $contact['name'] . ' ' . $contact['patronymic']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['gender']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['birthdate']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['phone']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['address']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['email']) . '</td>';
        $html .= '<td>' . htmlspecialchars($contact['comment']) . '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    if ($total_pages > 1) {
        $html .= '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $page) ? 'active' : '';
            $html .= "<a href='index.php?page=view&sort=$sort&p=$i' class='page-link $active'>$i</a>";
        }
        $html .= '</div>';
    }
    
    return $html;
}
?> 