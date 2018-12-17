<?php

use Phalcon\Mvc\Controller;
use Classes\FilesDownload;



class FileController extends BaseController {

    public function initialize() {
        parent::initialize();
    }
    
    public function getAction(){
        return FilesDownload::downloadByUri();
    }


}
