<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FilesDownload
 *
 * @author Wielq
 */

namespace Classes;

use SiteFiles;
use Phalcon\Mvc\User\Component;
use Phalcon\Http\Response;

class FilesDownload {

    protected static function getFile($hash) {
        $component = new Component();
        $files = SiteFiles::find([
                    'fileUri = :hash:',
                    'bind' => [
                        'hash' => $hash,
                    ]
        ]);
        if (!$files->count()) {
            return [404, 'Not found'];
        }
        $file = $files->getFirst();
        if ($file->userCreated != $component->session->get('idUser')) {
            return [403, 'Not access'];
        }
        return $file;
    }

    public static function downloadByUri() {
        $component = new Component();
        $params = $component->dispatcher->getParams();
        $hash = (string) \array_shift($params);
        $file = self::getFile($hash);
        $response = new Response();

        if ($file instanceof SiteFiles) {
            $dir = realpath('./data') . DIRECTORY_SEPARATOR . $file->filePath . "." . $file->fileExtenstion;
            if (file_exists($dir)) {
                $response->setContentType($file->fileMimeType);
                $response->setStatusCode(200, 'Ok');
                $response->setHeader("Cache-Control", "private, max-age=86400");
                $response->setHeader('X-Sendfile', $dir);
                $response->send();
            } else {
                $response->setStatusCode(404, 'Not found');
            }
        } else {
            $response->setStatusCode($file[0], $file[1]);
        }
        return $response;
    }

}
