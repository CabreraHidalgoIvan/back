<?php

function debug($data)
{
    $debug = debug_backtrace();
    echo '<pre>';
    echo $debug[0]['file'] . ' - ' . $debug[0]['line'] . '<br>';
    print_r($data);
    echo '</pre>';
    echo '<hr>';
}