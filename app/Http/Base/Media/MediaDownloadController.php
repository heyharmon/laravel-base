<?php

namespace DDD\Http\Base\Media;

use DDD\Domain\Base\Media\Media;
use DDD\App\Controllers\Controller;

class MediaDownloadController extends Controller
{
    public function download(Media $media)
    {
        return $media;
    }
}
