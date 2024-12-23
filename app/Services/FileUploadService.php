<?php
namespace App\Services;


class FileUploadService
{

    public static function fileUpload($file, $path ){

        $image = null;
        
        if ($file) {
            $imageName = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $imageName);
        }
        return $imageName;
    }

}