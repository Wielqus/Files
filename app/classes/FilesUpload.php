<?php

use Classes\File;
use Classes\FilesCommon;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FilesUpload
 *
 * @author Wielq
 */

namespace Classes;

class FilesUpload {

    public static function upload($files, $properties) {
        foreach ($files as $file) {
            $file = new File($file);
            if($file->validate($properties)){
                $file->upload();
            };
        }
        return $file->msg;
    }

}
