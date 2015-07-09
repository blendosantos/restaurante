<?php
/**
 * Description of HomeController
 *
 * @author Blendo Santos
 */
class HomeController extends BaseController{

    public function getIndex() {
        return View::make('home');
    }
}
