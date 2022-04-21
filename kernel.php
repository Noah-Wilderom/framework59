<?php

require_once('./app/Console/Kernel.php');
use Framework59\Kernel;

Kernel::add(['category' => 'Make', 'name' => 'controller', 'description' => 'usage: php kernel make controller PageController'], function($data) {
    print_r($data);
});

if(!isset($argv[1]) || in_array('help', $argv)) {
    Kernel::help();
}

if(isset($argv[1]) && isset($argv[2]) && isset($argv[3])) {
    if($argv[1] == 'make' && $argv[2] == 'controller') {
        $name = $argv[3];

        Kernel::execute(['make', 'controller'], $name);
    }
}
