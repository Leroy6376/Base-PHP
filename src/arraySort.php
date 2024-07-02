<?php

function arraySort(array $array, string $key = 'sort', int $sort = SORT_ASC): array
{
    $tempArray = $array;
    $callback = function ($a, $b) use ($key, $sort) {
        return $sort === SORT_ASC ? $a[$key] <=> $b[$key] : $b[$key] <=> $a[$key];
    };
    usort($tempArray, $callback);
    return $tempArray;
}
