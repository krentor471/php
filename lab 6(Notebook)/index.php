<?php
require_once 'menu.php';
require_once 'viewer.php';
require_once 'add.php';
require_once 'edit.php';
require_once 'delete.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'view';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .menu {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .menu-item, .submenu-item {
            display: inline-block;
            padding: 8px 15px;
            margin: 0 5px;
            text-decoration: none;
            color: #0066cc;
            border-radius: 3px;
        }
        .menu-item:hover, .submenu-item:hover {
            background-color: #f0f0f0;
        }
        .menu-item.active, .submenu-item.active {
            color: #cc0000;
        }
        .submenu {
            margin-top: 10px;
            font-size: 0.9em;
        }
        .contacts-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .contacts-table th, .contacts-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .contacts-table th {
            background-color: #f5f5f5;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .page-link {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 2px;
            text-decoration: none;
            color: #0066cc;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .page-link:hover {
            border: 2px solid #0066cc;
        }
        .page-link.active {
            background-color: #0066cc;
            color: #fff;
            border-color: #0066cc;
        }
        .contact-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        .form-group textarea {
            height: 100px;
        }
        button {
            background-color: #0066cc;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0052a3;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 3px;
        }
        .message.success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .message.error {
            background-color: #f2dede;
            color: #a94442;
        }
        .contacts-list {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .contact-link {
            display: block;
            padding: 8px;
            margin: 5px 0;
            text-decoration: none;
            color: #0066cc;
            border-radius: 3px;
        }
        .contact-link:hover {
            background-color: #f0f0f0;
        }
        .contact-link.active {
            background-color: #e6f3ff;
            color: #cc0000;
        }
    </style>
</head>
<body>
    <?php echo getMenu(); ?>
    
    <div class="content">
        <?php
        switch ($page) {
            case 'view':
                echo getContacts($sort, $p);
                break;
            case 'add':
                echo getAddForm();
                break;
            case 'edit':
                echo getEditForm();
                break;
            case 'delete':
                echo getDeleteList();
                break;
            default:
                echo getContacts($sort, $p);
        }
        ?>
    </div>
</body>
</html> 