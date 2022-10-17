<?php
namespace App\Http\Traits;

use App\Models\Gallery;

trait ImageUpload {

    public function gallerySaveImageDir($file, $dir) {
        $fileName = $file->getClientOriginalName();
        $timer = round(microtime(true)*1000);
        $fullFileName = $timer . $fileName;

        // handle contain file.
        $file->move(public_path($dir), $fullFileName);
        $gallery = Gallery::create([
            'name' => $fullFileName
        ]);
        return $gallery->id;
    }
}
