<?php
require_once 'db.php';

function getAddForm() {
    global $pdo;
    
    $message = '';
    $message_class = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (surname, name, patronymic, gender, birthdate, phone, address, email, comment) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $stmt->execute([
                $_POST['surname'],
                $_POST['name'],
                $_POST['patronymic'],
                $_POST['gender'],
                $_POST['birthdate'],
                $_POST['phone'],
                $_POST['address'],
                $_POST['email'],
                $_POST['comment']
            ]);
            
            $message = 'Запись добавлена';
            $message_class = 'success';
        } catch (PDOException $e) {
            $message = 'Ошибка: запись не добавлена';
            $message_class = 'error';
        }
    }
    
    $html = '';
    if ($message) {
        $html .= "<div class='message $message_class'>$message</div>";
    }
    
    $html .= '<form method="POST" class="contact-form">';
    $html .= '<div class="form-group"><label>Фамилия:</label><input type="text" name="surname" required></div>';
    $html .= '<div class="form-group"><label>Имя:</label><input type="text" name="name" required></div>';
    $html .= '<div class="form-group"><label>Отчество:</label><input type="text" name="patronymic"></div>';
    $html .= '<div class="form-group"><label>Пол:</label><select name="gender" required><option value="М">М</option><option value="Ж">Ж</option></select></div>';
    $html .= '<div class="form-group"><label>Дата рождения:</label><input type="date" name="birthdate" required></div>';
    $html .= '<div class="form-group"><label>Телефон:</label><input type="tel" name="phone" required></div>';
    $html .= '<div class="form-group"><label>Адрес:</label><input type="text" name="address" required></div>';
    $html .= '<div class="form-group"><label>Email:</label><input type="email" name="email" required></div>';
    $html .= '<div class="form-group"><label>Комментарий:</label><textarea name="comment"></textarea></div>';
    $html .= '<button type="submit">Добавить</button>';
    $html .= '</form>';
    
    return $html;
}
?> 