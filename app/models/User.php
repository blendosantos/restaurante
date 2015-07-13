<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;
    
    protected $table = 'users';
    protected $primaryKey = 'idPessoa';

    public static function buscaLogin($login) {
        $user = User::where('login', '=', $login)->get();
        if (count($user) == 0) {
            return true;
        }
        return false;
    }
    
    public static function buscaEmail($email) {
        $user = User::where('email', '=', $email)->get();
        if (count($user) == 0) {
            return true;
        }
        return false;
    }

}
