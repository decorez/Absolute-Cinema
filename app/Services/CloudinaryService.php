<?php

namespace App\Services;

use Cloudinary\Cloudinary;

class CloudinaryService
{
    protected Cloudinary $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('dym4cgp5g'),
                'api_key'    => env('136188877635917'),
                'api_secret' => env('C_fXQ4qNRfmI7HwBVlbRxkhQgW8'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    public function uploadImage($filePath, $folder = 'absolute-cinema')
    {
        return $this->cloudinary->uploadApi()->upload($filePath, [
            'folder' => $folder
        ]);
    }
}