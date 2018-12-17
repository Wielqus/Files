<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Classes\File;
use Classes\FilesUpload;
use Classes\FilesCommon;


class IndexController extends BaseController {

    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {
        $request = $this->request;
        if ($request->isPost()) {
            if ($this->request->hasFiles() == true) {
                $file = FilesUpload::upload($this->request->getUploadedFiles(), ['extension'=>['jpg','png'],'size'=> FilesCommon::SizeLarge]);
                $this->view->file = $file;
            } 
       }
       $files = SiteFiles::find([
           'userCreated = :user:',
           'bind'=>[
               'user'=>$this->session->get('idUser'),
           ]
       ]);
       $this->view->files = $files;
    }

}
