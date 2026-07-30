<?php

namespace App\Support;

class Consortium
{
    /**
     * List a partner's promotional collage images, each as an asset()-ready
     * relative URL plus a display name taken from the file's own title
     * (its filename without the extension).
     */
    public static function collageImages(string $folder): array
    {
        $directory = public_path('images/CollageSponsorPhotos/Collage Photos/'.$folder);

        $files = glob($directory.'/*.{jpg,jpeg,png}', GLOB_BRACE) ?: [];
        sort($files);

        return array_map(fn (string $file) => [
            'url' => implode('/', array_map(
                'rawurlencode',
                ['images', 'CollageSponsorPhotos', 'Collage Photos', $folder, basename($file)]
            )),
            'name' => pathinfo($file, PATHINFO_FILENAME),
        ], $files);
    }
}
