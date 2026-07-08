<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Api\Upload\UploadApi;

class CloudinaryService
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
        ]);
    }

    public function upload($file, $folder = 'products')
    {
        $result = (new UploadApi())->upload($file->getRealPath(), [
            'folder' => $folder,
        ]);
        
        return $result['secure_url'];
    }

    public function delete($publicId)
    {
        return (new UploadApi())->destroy($publicId);
    }
}