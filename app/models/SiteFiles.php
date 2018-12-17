<?php

use Phalcon\Mvc\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteFiles
 *
 * @author Wielq
 */



class SiteFiles extends Model  {

    public $id; //int(11) NO NULL PRIMARY auto_increment
    public $fileName; //varchar(255) NO NULL
    public $fileMimeType; //varchar(255) NO NULL
    public $filePath; //varchar(255) NO NULL
    public $fileUri; //varchar(50) NO NULL
    public $fileExtenstion; //varchar(10) NO NULL
    public $fileSize; //int(11) NO NULL
    public $userCreated; //int(11) NO NULL
    public $timeCreated; //int(11) NO NULL

    public function getSource() {
        return 'SiteFiles';
    }

}
