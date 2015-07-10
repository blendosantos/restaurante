<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public static function userPerfil($id) {
        return User::where('idPessoa', '=', $id)->get();
    }

    public static function buscaLogin($login) {
        $user = User::where('login', '=', $login)->get();
        if (count($user) == 0) {
            return true;
        }
        return false;
    }

}
