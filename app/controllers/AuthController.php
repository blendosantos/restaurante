<?php

/**
 * Description of AuthController
 *
 * @author Blendo.Santos
 */
class AuthController extends BaseController {

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

    public function getCadastro() {
        return View::make('cadastro-user');
    }

    public function postCadastro() {
        $nmPessoa = Input::get('nmPessoa');
        $dtNascimento = Input::get('dtNascimento');
        $cpf = Input::get('cpf');
        $sexo = Input::get('sexo');
        $cep = Input::get('cep');
        $cidade = Input::get('cidade');
        $estado = Input::get('estado');
        $bairro = Input::get('bairro');
        $endereco = Input::get('endereco');
        $numero = Input::get('numero');
        $complemento = Input::get('complemento');
        $login = Input::get('login');
        $cargo = Input::get('cargo');

        $id = Input::get('id');

        if (isset($id)) {
            $pessoa = Pessoa::find($id);
            $pessoa->nmPessoa = $nmPessoa;
            $pessoa->dtNascimento = $dtNascimento;
            $pessoa->cpf = $cpf;
            $pessoa->sexo = $sexo;
            $pessoa->cep = $cep;
            $pessoa->cidade = $cidade;
            $pessoa->estado = $estado;
            $pessoa->bairro = $bairro;
            $pessoa->endereco = $endereco;
            $pessoa->complemento = $complemento;
            $pessoa->numero = $numero;
            $pessoa->status = 'AT';
            if (Input::hasFile('img')) {
                $img = Input::file('img');
                $img->move('upload/', $img->getClientOriginalName());
                $pessoa->img = 'upload/' . $img->getClientOriginalName();
            }

            $usuario = User::userPerfil($pessoa->id);
            $usuario->login = $login;
            $usuario->perfil = $cargo;
        } else {
            $pessoa = new Pessoa();
            $pessoa->nmPessoa = $nmPessoa;
            $pessoa->dtNascimento = $dtNascimento;
            $pessoa->cpf = $cpf;
            $pessoa->sexo = $sexo;
            $pessoa->cep = $cep;
            $pessoa->cidade = $cidade;
            $pessoa->estado = $estado;
            $pessoa->bairro = $bairro;
            $pessoa->endereco = $endereco;
            $pessoa->numero = $numero;
            $pessoa->complemento = $complemento;
            $pessoa->status = 'AT';
            if (Input::hasFile('img')) {
                $img = Input::file('img');
                $img->move('upload/', $img->getClientOriginalName());
                $pessoa->img = 'upload/' . $img->getClientOriginalName();
            }

            $usuario = new User();
            $usuario->login = $login;
            $usuario->perfil = $cargo;
        }

        if (Pessoa::buscaCPF($cpf)) {
            $pessoa->save();
        }

        if (User::buscaLogin($login)) {
            $usuario->save();
        }
        
        return View::make('/usuario');
    }

    public function getIndex() {
        return View::make('lista-user');
    }

}
