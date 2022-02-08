<?php

namespace Demiancy\Instagram\lib;

class UtilImages
{
    public static function store(array $image, string $folder = ''): string
    {
        $targetDir  = "public/images/$folder/";
        $extarr     = explode('.', $image["name"]);
        $filename   = $extarr[sizeof($extarr)-2];
        $ext        = $extarr[sizeof($extarr)-1];
        $hash       = md5(Date('Ymdgi') . $filename) . '.' . $ext;
        $targetFile = $targetDir . $hash;
        $check      = getimagesize($image["tmp_name"]);

        if (
            ($check === false) 
            || (!move_uploaded_file($image["tmp_name"], $targetFile))
        ) {
            throw new \Exception('Sorry, your file was not uploaded.', 1);
        }

        return $hash;
    }
}