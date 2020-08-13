<?php

use App\Services\Services;

function twig () {
    return Services::get('twig');
}

function request () {
    return Services::get('request');
}

function router () {
    return Services::get('router');
}

