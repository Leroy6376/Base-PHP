<?php

function formatPrice(int $price): string
{
    return number_format(num: $price, thousands_separator: ' ') . ' ₽';
}
