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
        $id = Input::get('id');
        if (isset($id)) {
            $usuario = Pessoa::find($id);
            $login = User::find($id);
            return View::make('cadastro-user', compact('usuario','login'));
        }
        return View::make('cadastro-user');
    }

    public function postCadastro() {
        //Atributos
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
        $senha = Input::get('senha');
        $id = Input::get('id');
        $email = Input::get('email');
        $telefone = Input::get('telefone');
        $vlSalario = str_replace(array("R$", "."), "", Input::get('vlSalario'));
        $vlSalario = str_replace(",", ".", $vlSalario);
        //Gera Senha Aleatoria
        if (empty($senha)) {
            $senha = Hash::make(Util::geraSenha(8, true, true, true));
        }
        //Caso o usuario cadastro seja cliente limpa o campo salario.
        if ($cargo == 'CLI') {
            $vlSalario = 0;
        }

        //Editar
        if (isset($id)) {
            $pessoa = Pessoa::find($id);
            $pessoa->nmPessoa = $nmPessoa;
            $pessoa->dtNascimento = $dtNascimento;
            $pessoa->sexo = $sexo;
            $pessoa->cep = $cep;
            $pessoa->cidade = $cidade;
            $pessoa->estado = $estado;
            $pessoa->bairro = $bairro;
            $pessoa->endereco = $endereco;
            $pessoa->complemento = $complemento;
            $pessoa->numero = $numero;
            $pessoa->status = 'AT';
            $pessoa->telefone = $telefone;
            if (Input::hasFile('img')) {
                $img = Input::file('img');
                $img->move('upload/', $img->getClientOriginalName());
                $pessoa->img = 'upload/' . $img->getClientOriginalName();
            }
            $pessoa->vlSalario = $vlSalario;

            if ($cpf != $pessoa->cpf) {
                if (Pessoa::buscaCPF($cpf)) {
                    $pessoa->cpf = $cpf;
                } else {
                    return Redirect::to('usuario/cadastro')->with('message', 'CPF já esta sendo utilizado!')->withInput();
                }                
            }
            $pessoa->save();
            $usuario = User::find($id);
            if ($cargo != $usuario->perfil) {
                $usuario->perfil = $cargo;
            }
            if ($email != $usuario->email) {
                if (User::buscaEmail($email)) {
                    $usuario->email = $email;
                } else {
                    return Redirect::to('usuario/cadastro')->with('message', 'Email já esta sendo utilizado!')->withInput();
                }
            }
            if ($login != $usuario->login) {
                if (User::buscaLogin($login)) {
                    $usuario->login = $login;
                } else {
                    return Redirect::to('usuario/cadastro')->with('message', 'Usuário já esta sendo utilizado!')->withInput();
                }                
            }
            $usuario->save();
            return Redirect::to('usuario');
        }
        //Novo Cadastro
        else {
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
            $pessoa->vlSalario = $vlSalario;
            $pessoa->telefone = $telefone;
            if (Input::hasFile('img')) {
                $img = Input::file('img');
                $img->move('upload/', $img->getClientOriginalName());
                $pessoa->img = 'upload/' . $img->getClientOriginalName();
            }

            if (Pessoa::buscaCPF($cpf)) {
                $pessoa->save();

                $usuario = new User();
                $usuario->login = $login;
                $usuario->perfil = $cargo;
                $usuario->password = $senha;
                $usuario->idPessoa = $pessoa->id;
                $usuario->status = 'AT';
                $usuario->email = $email;

                if (User::buscaLogin($login)) {
                    $usuario->save();
                } else {
                    return Redirect::to('usuario/cadastro')->with('message', 'Usuário já esta sendo utilizado!')->withInput();
                }
            } else {
                return Redirect::to('usuario/cadastro')->with('message', 'CPF já esta sendo utilizado!')->withInput();
            }
        }
        return Redirect::to('usuario');
    }

    public function getIndex() {
        $usuario = Pessoa::all();
        return View::make('lista-user', compact('usuario'));
    }
    
    public function getAtivar() {
        $id = Input::get('id');
        $usuario = Pessoa::find($id);
        $usuario->status = 'AT';
        $usuario->save();
        return Redirect::to('/usuario');
    }
    
    public function getInativar() {
        $id = Input::get('id');
        $usuario = Pessoa::find($id);
        $usuario->status = 'IN';
        $usuario->save();
        return Redirect::to('/usuario');
    }

    public static function getDelete() {
        $id = Input::get('id');
        $usuario = Pessoa::find($id);
        $usuario->delete();
        return Redirect::to('/usuario');
    }
    
    public static function getNomeToId($id) {
        return Pessoa::find($id)->nmPessoa;
    }
    
    public static function getTelefoneToId($id) {
        return Pessoa::find($id)->telefone;
    }
    
    public static function getUserActive() {
        return Pessoa::where('status', 'AT')->lists('nmPessoa', 'id');
    }
}
