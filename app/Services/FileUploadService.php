<?php
namespace App\Services;


class FileUploadService
{

    public static function fileUpload($file, $path ){

        $image = '';
        
        if ($file) {
            $image = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file('image')->storeAs('/products', $image);
        }
    }

}