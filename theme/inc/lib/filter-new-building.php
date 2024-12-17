<?php

$names_default_cities = [
    'Краснодарский край' => 'Новороссийск',
    'Новосибирская область' => 'Центральный район',
    'Санкт-Петербург' => 'Кронштадтский р-н',
    'Москва' => 'Басманный',
    'Ростовская область' => 'Железнодорожный район',
    'Казанская область' => 'Казань',
    'Свердловская область' => 'Екатеринбург'
];

$type = $_GET['type'];
$where = '/' . $type . '/?';

if (isset($_GET['option-radio-region']) && $_GET['option-radio-region'] != '') {
    $where .= '&region=' . $_GET['option-radio-region'];
}

if (isset($_GET['option-radio-city']) && $_GET['option-radio-city'] != '') {
    $where .= '&city=' . $_GET['option-radio-city'];
}

if (isset($_GET['option-radio-region']) && $_GET['option-radio-region'] != '' && (!isset($_GET['option-radio-city']) || $_GET['option-radio-city'] == '')) {
    $where .= '&city=' . $names_default_cities[$_GET['option-radio-region']];
}

if (isset($_GET['option-radio-type-build']) && $_GET['option-radio-type-build'] != '') {
    $where .= '&type-build=' . $_GET['option-radio-type-build'];
}

if (isset($_GET['option-checkbox-rooms']) && !empty($_GET['option-checkbox-rooms'])) {
    $rooms = $_GET['option-checkbox-rooms']; // Получаем массив

    // Преобразуем массив в строку, разделяя элементы запятой
    $rooms_string = implode(',', $rooms);

    // Добавляем в $where, используя правильный формат
    $where .= '&rooms=' . urlencode($rooms_string); // Используем urlencode для безопасного добавления в URL
}
if (isset($_GET['select-price']) && $_GET['select-price'] != '' && $_GET['desctop'] != '') {
    $where .= '&select_price=' . $_GET['select-price'];
}
if (isset($_GET['select-area']) && $_GET['select-area'] != '' && $_GET['desctop'] != '') {
    $where .= '&select_area=' . $_GET['select-area'];
}

if (isset($_GET['option-select-area-from']) && $_GET['option-select-area-from'] != '' && $_GET['option-select-area-to'] && $_GET['option-select-area-to'] != ''   && $_GET['desctop'] == '') {
    $where .= '&select_area=' . $_GET['option-select-area-from'] . '-' . $_GET['option-select-area-to'];
}
if (isset($_GET['option-select-price-from']) && $_GET['option-select-price-from'] != '' && $_GET['option-select-price-to'] && $_GET['option-select-price-to'] != ''   && $_GET['desctop'] == '') {
    $where .= '&select_price=' . $_GET['option-select-price-from'] . '-' . $_GET['option-select-price-to'];
}

if (isset($_GET['check-price'])) {
    $where .= '&check_price=' . $_GET['check-price'];
}

if ($where == '/novostrojki/?') $where = '/novostrojki/';
if ($where == '/buildings_map/?') $where = '/buildings_map/';

header('Location: ' . $where);
