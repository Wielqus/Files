<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FilesCommon
 *
 * @author Wielq
 */

namespace Classes;

class FilesCommon{
        
    
    const SizeMini = 1000;
     
    const SizeMedium = 100000;
    
    const SizeLarge = 100000000;
    
     public static $filesTypes = [  
        'image/jpeg' => ['type' => 'image', 'extension' => 'jpg'],
        'image/png' => ['type' => 'image', 'extension' => 'png'],
        'audio/ogg' => ['type' => 'audio', 'extension' => 'ogg'],
        'audio/mpeg' => ['type' => 'audio', 'extension' => 'mp3'],
        'video/mp4' => ['type' => 'video', 'extension' => 'mp4'],
        'video/webm' => ['type' => 'video', 'extension' => 'webm'],
        'video/ogg' => ['type' => 'video', 'extension' => 'ogg'],
        'application/msword' => ['type' => 'document', 'extension' => 'doc'],
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => ['type' => 'document', 'extension' => 'docx'],
        'application/vnd.oasis.opendocument.text' => ['type' => 'document', 'extension' => 'odt'],
        'application/pdf' => ['type' => 'document', 'extension' => 'pdf'],
    ];
     
}
