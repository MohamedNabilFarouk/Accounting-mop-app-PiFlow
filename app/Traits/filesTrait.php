<?php

namespace App\Traits;


trait filesTrait
{

    function saveFiles($file, $folder)
    {
        // $file_name = $file -> hashName();
        $file_name = $file -> hashName();
        $path = $folder;
        $file -> move($path, $file_name);
        return $file_name;
    }

}




