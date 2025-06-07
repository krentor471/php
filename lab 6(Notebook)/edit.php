<?php
require_once 'db.php';

function getEditForm() {
    global $pdo;
    
    $stmt = $pdo->query("SELECT id, surname, name FROM contacts ORDER BY surname, name");
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $html = '<div class="contacts-list">';
    foreach ($contacts as $contact) {
        $active = (isset($_GET['id']) && $_GET['id'] == $contact['id']) ? 'active' : '';
        $html .= "<a href='index.php?page=edit&id={$contact['id']}' class='contact-link $active'>";
        $html .= htmlspecialchars($contact['surname'] . ' ' . $contact['name']);
        $html .= '</a>';
    }
    $html .= '</div>';
    
    if (!isset($_GET['id']) && !empty($contacts)) {
        $_GET['id'] = $contacts[0]['id'];
    }
    
    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM contacts WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($contact) {
            $html .= '<form method="POST" class="contact-form">';
            $html .= '<input type="hidden" name="id" value="' . $contact['id'] . '">';
            $html .= '<div class="form-group"><label>Фамилия:</label><input type="text" name="surname" value="' . htmlspecialchars($contact['surname']) . '" required></div>';
            $html .= '<div class="form-group"><label>Имя:</label><input type="text" name="name" value="' . htmlspecialchars($contact['name']) . '" required></div>';
            $html .= '<div class="form-group"><label>Отчество:</label><input type="text" name="patronymic" value="' . htmlspecialchars($contact['patronymic']) . '"></div>';
            $html .= '<div class="form-group"><label>Пол:</label><select name="gender" required>';
            $html .= '<option value="М"' . ($contact['gender'] == 'М' ? ' selected' : '') . '>М</option>';
            $html .= '<option value="Ж"' . ($contact['gender'] == 'Ж' ? ' selected' : '') . '>Ж</option>';
            $html .= '</select></div>';
            $html .= '<div class="form-group"><label>Дата рождения:</label><input type="date" name="birthdate" value="' . $contact['birthdate'] . '" required></div>';
            $html .= '<div class="form-group"><label>Телефон:</label><input type="tel" name="phone" value="' . htmlspecialchars($contact['phone']) . '" required></div>';
            $html .= '<div class="form-group"><label>Адрес:</label><input type="text" name="address" value="' . htmlspecialchars($contact['address']) . '" required></div>';
            $html .= '<div class="form-group"><label>Email:</label><input type="email" name="email" value="' . htmlspecialchars($contact['email']) . '" required></div>';
            $html .= '<div class="form-group"><label>Комментарий:</label><textarea name="comment">' . htmlspecialchars($contact['comment']) . '</textarea></div>';
            $html .= '<button type="submit">Сохранить</button>';
            $html .= '</form>';
        }
    }
    
    return $html;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    try {
        $stmt = $pdo->prepare("UPDATE contacts SET 
            surname = ?, name = ?, patronymic = ?, gender = ?, 
            birthdate = ?, phone = ?, address = ?, email = ?, comment = ? 
            WHERE id = ?");
        
        $stmt->execute([
            $_POST['surname'],
            $_POST['name'],
            $_POST['patronymic'],
            $_POST['gender'],
            $_POST['birthdate'],
            $_POST['phone'],
            $_POST['address'],
            $_POST['email'],
            $_POST['comment'],
            $_POST['id']
        ]);
        
        header("Location: index.php?page=edit&id=" . $_POST['id']);
        exit;
    } catch (PDOException $e) {
    }
}
?> 