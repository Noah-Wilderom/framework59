<?php
namespace Framework59\App\Http\Controllers;

use Framework59\App\Controller;
use Framework59\App\Models\UserModel;
use Framework59\Models\UserController;

class HomeController extends Controller {

    public function index($id) 
    {
        new UserModel();
        UserModel::all();
        return $this->view('index');
    }
    public function home() 
    {
        return $this->view('home', ['testing', ' de ', 'data functionaliteit']);
    }
}