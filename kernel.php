<?php

require_once('./app/Console/Kernel.php');
use Framework59\Kernel;

Kernel::add(['category' => 'Make', 'name' => 'controller', 'description' => 'usage: php kernel make controller PageController'], function($data) {
    $stub = Kernel::stubCommand('controller', ['[Controller]' => $data[3]]);
    $file = file_put_contents('./app/Http/Controllers/' . $data[3] . '.php', $stub);
    if($file) {
        print_r(Kernel::printColor('Controller has been created successfully', 'green'));
        exit();
    } else {
        print_r(Kernel::printColor('Controller creating has failed', 'red'));
        exit();
    }

});

if(!isset($argv[1]) || in_array('help', $argv)) {
    Kernel::help();
}

if(isset($argv[1]) && isset($argv[2]) && isset($argv[3])) {
    Kernel::execute([$argv[1], $argv[2]], $argv);
}
