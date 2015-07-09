<?php

/**
 * Description of AuthController
 *
 * @author Blendo.Santos
 */
class AuthController extends BaseController{
    
    public function getLogin() {
        return View::make('login');
    }
    
    public function postLogin() {
        return "logado";
    }
    
    public function getResertPassword() {
        return View::make('login');
    }
    
    public function postResertPassword() {
        return "Senha Resetada";
    }
    
    public function getCadastroUser() {
        return View::make('cadastro-user');
    }
    
    public function postCadastroUser() {
        return "Cadastro de Usuário";
    }
}
