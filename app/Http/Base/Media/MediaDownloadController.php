<?php

namespace DDD\Http\Base\Media;

use DDD\App\Controllers\Controller;
// Models
use DDD\Domain\Base\Media\Media;

class MediaDownloadController extends Controller
{
    public function download(Media $media)
    {
        return $media;
    }
}
