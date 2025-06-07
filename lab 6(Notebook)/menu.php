<?php
function getMenu() {
    $current_page = isset($_GET['page']) ? $_GET['page'] : 'view';
    $current_sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
    
    $menu = '<div class="menu">';
    
    $menu_items = [
        'view' => 'Просмотр',
        'add' => 'Добавление записи',
        'edit' => 'Редактирование записи',
        'delete' => 'Удаление записи'
    ];
    
    foreach ($menu_items as $key => $value) {
        $active = ($current_page === $key) ? 'active' : '';
        $menu .= "<a href='index.php?page=$key' class='menu-item $active'>$value</a>";
    }
    
    if ($current_page === 'view') {
        $menu .= '<div class="submenu">';
        $sort_items = [
            'default' => 'По порядку добавления',
            'surname' => 'По фамилии',
            'birthdate' => 'По дате рождения'
        ];
        
        foreach ($sort_items as $key => $value) {
            $active = ($current_sort === $key) ? 'active' : '';
            $menu .= "<a href='index.php?page=view&sort=$key' class='submenu-item $active'>$value</a>";
        }
        $menu .= '</div>';
    }
    
    $menu .= '</div>';
    
    return $menu;
}
?> 