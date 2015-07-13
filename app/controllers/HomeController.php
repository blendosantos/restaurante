<?php
/**
 * Description of HomeController
 *
 * @author Blendo Santos
 */
class HomeController extends BaseController{

    public function getIndex() {
        $servicos = Servico::destaques();
        return View::make('home', compact('servicos'));
    }
}
