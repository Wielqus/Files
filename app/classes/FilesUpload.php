<?php

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

use Classes\File;
use Classes\FilesCommon;
use Phalcon\Validation\Exception;
use SiteFiles;
use Phalcon\Config;
use Phalcon\Mvc\User\Component;

class FilesUpload {

    public static function upload($files, $properties) {
        foreach ($files as $file) {
            if (self::validate($file, $properties)) {
                return self::moveFile($file);
            }
        }
        return $file;
    }

    protected static function validate($file, $properties) {
        if ($properties['extension']) {
            $allowedExtension = $properties['extension'];
            if (!in_array($file->getExtension(), $allowedExtension)) {
                return 0;
            }
        } else {
            $allowedExtension = FilesCommon::$filesTypes;
            if (!in_array($file->getExtension(), $allowedExtension)) {
                return 0;
            }
        }

        if ($properties['size']) {
            if ($file->getSize() > $properties['size']) {
                return 0;
            }
        } else {
            if ($file->getSize() > FilesCommon::SizeLarge) {
                return 0;
            }
        }
        return 1;
    }

    protected static function userDirectory(): string {
        $component = new \Phalcon\Mvc\User\Component();
        $user = $component->session->get('userId');
        $userFolder = sha1($user);
        $userDir = realpath('./data') . DIRECTORY_SEPARATOR . $userFolder;
        if (!\is_dir($userDir)) {
            if (!mkdir($userDir, 0777)) {
                return 0;
            }
        }
        return $userFolder;
    }

    protected static function moveFile($file) {
        $db = \Phalcon\Di::getDefault()->get('db');
        $component = new Component();
        $fileName = sha1($_SERVER['REQUEST_TIME']);
        $db->begin();
        $SiteFile = new SiteFiles();
        $SiteFile->fileExtenstion = $file->getExtension();
        $SiteFile->fileMimeType = $file->getType();
        $SiteFile->fileName = $file->getName();
        $SiteFile->filePath = self::userDirectory() . '/' . $fileName;
        $SiteFile->fileSize = $file->getSize();
        $SiteFile->fileUri = self::userDirectory() . '-' . $fileName;
        $SiteFile->timeCreated = $_SERVER['REQUEST_TIME'];
        $SiteFile->userCreated = $component->session->get('idUser');
        if (!$SiteFile->save()) {
            foreach ($SiteFile->getMessages() as $message) {
                return $message;
            }
            return FALSE;
        }
        if ($file->moveTo(realpath('./data') . DIRECTORY_SEPARATOR . self::userDirectory() . DIRECTORY_SEPARATOR . $fileName . '.' . $file->getExtension())) {
            $db->commit();
            return TRUE;
        } else {
            $db->rollback();
            return FALSE;
        }
    }

}
