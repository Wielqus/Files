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

class File {
    
    public $name;
    
    public $type;
    
    public $extension;
    
    public $size;
    
    public $tmp;
    
    public $msg =[];
    
    public $isUpload=false;
       
    function __construct($file) {
        $this->name = $file->getName();
        $this->type = $file->getType();
        $this->extension = $file->getExtension();
        $this->size = $file->getSize();
        $this->tmp = $file->getTempName();
    }
    
    public function validate($properties){
        if($properties['extension']){
            $allowedExtension = $properties['extension'];
            if (!in_array($this->extension, $allowedExtension)){
                array_push($this->msg,'Not allowed extension');
                return 0;
            }
        }else{
            $allowedExtension = FilesCommon::$filesTypes;
            if (!in_array($this->extension, $allowedExtension)){
                array_push($this->msg,'Not allowed extension');
                return 0;
            }
        }
        
        if($properties['size']){
            if($this->size>$properties['size']){
                array_push($this->msg,'Not allowed size');
                return 0;
            }
        }else{
            if($this->size>FilesCommon::SizeLarge){
                array_push($this->msg,'Not allowed size');
                return 0;
            }
        }
        return 1;
    }
    
    public function upload(){
        
    }
}
