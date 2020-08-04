<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Http\Traits\FilesUpload;
use App\Upload;


class StoreAwsController extends Controller
{

    use FilesUpload;

    public function storeFile(Request $request) {

        // do not forget to require auth to store file
        
        try {

            $files = $request->file('files');

            //validate before uploading

            foreach ($files as $file)
            {
                $cloudPath = $file->store('files/documents', 's3');

                if (!$cloudPath) {
                    dd('An error has ocurred, error 1 ' . $ex->getMessage());
                }

                $this->saveFileToDB($file, $cloudPath);                
            } 

            dd('ok');

        }catch(\Exception $ex) {
            dd('An error has ocurred, error 2 ' . $ex->getMessage());
        }  
        
    }

    public function getFile(Request $request, $id) {

        // do not forget to require auth to download file

        $file = Upload::find($id);

        if (!$file) {
            dd('file not found');
        }

        $s3File = Storage::disk('s3')->get($file->cloud_path);

        $headers = [
            'Content-Type' => $file->mime_type, 
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => "attachment; filename={$file->original_name}",
            'filename'=> $file->original_name
        ];

        return response($s3File, 200, $headers);
    }

    public function deleteFile(Request $request, $id) {

        // do not forget to require auth to delete file

        $file = Upload::find($id);

        if (!$file) {
            dd('file not found');
        }

        $s3File = Storage::disk('s3')->delete($file->cloud_path);

        $file->delete();

        return back();
    }

    public function getFilesData() {
        $files = Upload::all();
        return view('files')->with('files', $files);
    }
    
}
