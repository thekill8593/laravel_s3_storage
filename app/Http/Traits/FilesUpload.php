<?php

namespace App\Http\Traits;
use App\Upload;


trait FilesUpload {

    protected function saveFileToDB($file, $cloudPath) {
        Upload::create([
            'original_name' => str_replace(" ",  "_", $file->getClientOriginalName()),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'cloud_path' => $cloudPath
        ])->save();
    }

}