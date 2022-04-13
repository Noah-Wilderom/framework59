<?php
namespace Framework59\App;

use Exception;

class Controller {

    public function view(string $view, array $data = []) {
        $arr = explode('.', $view);
        if(!$arr) $view = str_replace('.', '/', $view);
        if(file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            throw new Exception('[Framework59] View ' . $view . ' does not exist.');
        }
    }

    public function redirect(string $url) {
        header("Location: " . config['URLROOT'] . $url);
    }
}