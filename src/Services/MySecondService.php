<?php

namespace App\Services;

class MySecondService implements ServiceInterface
{

    public function __construct()
    {
        dump('Bonjour de second service!');
    }
}