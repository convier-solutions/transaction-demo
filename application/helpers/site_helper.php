<?php
// date_default_timezone_set("Europe/Paris");
date_default_timezone_set("America/New_York");

function pr($data, $exit = 0)
{
    print '<pre>';
    print_r($data);
    print '</pre>';

    if ($exit == 1) {
        exit;
    }
}