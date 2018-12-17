<?php


use Phalcon\Mvc\Controller;

class BaseController extends Controller {

    public function initialize() {
        $this->session->set('idUser',4);
    }


}
