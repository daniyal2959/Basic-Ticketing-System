<?php

namespace App\Classes;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class Zip
{
    public static function extract($file, $destination)
    {
        $dir_path = date('Y') . '/' . date('m') . '/';
        $zip = new ZipArchive();
        $file_new_path = $file->storeAs($dir_path . 'zip' , Str::uuid(), 'local');
        $zipFile = $zip->open(Storage::disk('local')->path($file_new_path));
        if ($zipFile === TRUE) {
            $zip->extractTo($destination);
            $zip->close();
        }
        File::deleteDirectory(Storage::disk('local')->path(date('Y')));
    }

    public static function check($directoryToBeCheck, $directorySource)
    {
        $directoryToBeCheckContent = self::getContent($directoryToBeCheck);
        $directorySourceContent = self::getContent($directorySource);

        return implode(',',array_diff($directorySourceContent, $directoryToBeCheckContent));
    }

    public static function getContent($directoryToBeCheck)
    {
        $zip = new ZipArchive();
        $zip->open($directoryToBeCheck);
        $content = [];

        for( $i = 0; $i < $zip->numFiles; $i++ ){
            $stat = $zip->statIndex( $i );

            $data = $stat['name'];
            $content[] = $data;
        }
        return array_unique($content);
    }

    public static function getName($file)
    {
        $zip = new ZipArchive();
        $zip->open($file);
        return explode('/', $zip->statIndex(0)['name'])[0];
    }
}
