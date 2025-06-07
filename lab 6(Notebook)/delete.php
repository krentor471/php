<?php
require_once 'db.php';

function getDeleteList() {
    global $pdo;
    
    if (isset($_GET['id'])) {
        try {
            $stmt = $pdo->prepare("SELECT surname FROM contacts WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $contact = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($contact) {
                $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
                $stmt->execute([$_GET['id']]);
                
                echo "<div class='message success'>Запись с фамилией " . htmlspecialchars($contact['surname']) . " удалена</div>";
            }
        } catch (PDOException $e) {
            echo "<div class='message error'>Ошибка при удалении записи</div>";
        }
    }
    
    $stmt = $pdo->query("SELECT id, surname, name FROM contacts ORDER BY surname, name");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '<div class="contacts-list">';
    foreach ($contacts as $contact) {
        $html .= "<a href='index.php?page=delete&id={$contact['id']}' class='contact-link'>";
        $html .= htmlspecialchars($contact['surname'] . ' ' . substr($contact['name'], 0, 1) . '.');
        $html .= '</a>';
    }
    $html .= '</div>';
    
    return $html;
}
?> 