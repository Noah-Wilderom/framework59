<?php
namespace Framework59\App\Models;

use Framework59\Model;

class UserModel extends Model {

    public function __construct() {
        self::$table = 'users';
    }
}