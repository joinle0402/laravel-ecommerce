<?php
namespace App\Traits;

use Intervention\Image\ImageManagerStatic as Image;

trait UploadImageTrait
{
    private $baseDir;

    public function saveImage($request)
    {
        if ($request->file('image'))
        {
            $image = $request->file('image');
            $filename = $this->baseDir.'/'.time().'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save($filename);
            return $filename;
        }
    }

    public function updateImage($request, $currentImage)
    {
        if ($request->has('image'))
        {
            $this->deleteImage($currentImage);

            return $this->saveImage($request);
        }

        return $currentImage;
    }

    public function deleteImage(string $imagePath)
    {
        if (file_exists($imagePath))
        {
            unlink($imagePath);
        }
    }

    public function baseDir(string $baseDir = 'uploads/users')
    {
        $this->baseDir = $baseDir;
        return $this;
    }
}
