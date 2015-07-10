<?php

/**
 * Description of Pessoa
 *
 * @author Blendo.Santos
 */
class Pessoa extends Eloquent {

    protected $table = 'pessoa';
    protected $guarded = array('id');

    public static function buscaCPF($cpf) {
        $pessoa = Pessoa::where('cpf', '=', $cpf)->get();
        if (count($pessoa) == 0 ) {
            return true;
        }
        return false;
    }

}
