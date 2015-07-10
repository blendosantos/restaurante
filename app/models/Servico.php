<?php

/**
 * Description of Servico
 *
 * @author Blendo.Santos
 */
class Servico extends Eloquent {
    
    protected $table = 'servico';
    
    protected $guarded = array('id');
    
    public static function destaques(){
        return Servico::where('destaque', '=', 'S')->get();
    }
}
