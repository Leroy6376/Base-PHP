<?php

function getMenu(bool $isAuthorised) : array
{
    $menuArray = [
        [
            'title' => 'Главная',
            'path' => '/',
            'sort' => 1,
            'needAuthorize' => false,
        ],
        [
            'title' => 'Рога',
            'path' => '/horns/',
            'sort' => 2,
            'needAuthorize' => false,
        ],
        [
            'title' => 'Сила',
            'path' => '/force/',
            'sort' => 3,
            'needAuthorize' => false,
        ],
        [
            'title' => 'Длинный раздел',
            'path' => '/section/',
            'sort' => 4,
            'needAuthorize' => false,
        ],
        [
            'title' => 'Каталог',
            'path' => '/catalog/',
            'sort' => 5,
            'needAuthorize' => true,
        ],
    ];

    if (!$isAuthorised) {
        for ($i = 0; $i < count($menuArray); $i++) {
            if ($menuArray[$i]['needAuthorize']) {
                unset($menuArray[$i]);
            }
        }
    }
    return $menuArray;
}
