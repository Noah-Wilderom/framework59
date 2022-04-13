<?php
namespace Framework59\App\Http\Controllers;

use Framework59\App\Controller;
use Framework59\Models\UserController;

class HomeController extends Controller {

    public function index() {
        return $this->view('index');
    }
    public function home() {
        return $this->view('home', ['testing', ' de ', 'data functionaliteit']);
    }
}