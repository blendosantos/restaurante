<?php
/**
 * Description of Util
 *
 * @author Blendo.Santos
 */
class Util extends BaseController{
    
    /*
    * Valor = Double, com ponto. Função retornar double substituindo o ponto por virgula.
    */
    public static function formatValor($valor) {
        $retorn = str_replace(".", ",", $valor);
        return $retorn;
    }
}
