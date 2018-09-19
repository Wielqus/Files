<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of File
 *
 * @author Wielq
 * 
 */

namespace Classes;

use Phalcon\Mvc\User\Component;
use Phalcon\Validation\Exception;
use Models\SiteFiles;

class File extends Component {

    public $name;
    public $type;
    public $extension;
    public $size;
    public $tmp;
    public $msg = [];
    public $isUpload = false;

    function __construct($file) {
        $this->name = $file->getName();
        $this->type = $file->getType();
        $this->extension = $file->getExtension();
        $this->size = $file->getSize();
        $this->tmp = $file->getTempName();
    }


    public function upload() {
        $db = \Phalcon\Di::getDefault()->get('db');
        
        $db->begin();
        $dir = $this->createDirectory();
        if (!$dir)
            return 0;
        

        return $this->createDirectory();
    }

}
