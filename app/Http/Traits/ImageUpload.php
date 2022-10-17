<?php
namespace App\Http\Traits;

use App\Models\Gallery;
use Illuminate\Support\Facades\File;

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

    public function deleteOldGallery ($gallery_id, $dir) {
        $gallery = Gallery::findOrFail($gallery_id);
        $image = public_path($dir . $gallery->url);
        dd($image);
        if (is_null($gallery->name))
            File::delete($image);
        $gallery->delete();
    }
}
