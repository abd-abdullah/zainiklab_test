<?php

namespace app\Utilities;

use Illuminate\Support\Facades\Storage;
/**
 * Class FileUpload
 * Author@Md Abdullah
 */
class FileUploader
{
    /**
     * upload file
     *
     * @param string $file
     * @param string $path
     *
     * @return NULL|string
     */
    public static function upload($file, $path = 'uploads')
    {
        $request = request();
        if($request->hasFile($file)){
            $uploadedFile = $request->file($file);
            $filename = time() . $uploadedFile->getClientOriginalName();

            Storage::putFileAs(
                $path,
                $uploadedFile,
                $filename
            );

            return $path . DIRECTORY_SEPARATOR . $filename;
        }
        
        return NULL;
    }
}

?>