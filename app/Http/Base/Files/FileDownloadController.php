<?php

namespace DDD\Http\Base\Files;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Models
use DDD\Domain\Base\Files\File;

class FileDownloadController extends Controller
{
    public function download(File $file)
    {
        // return Storage::disk('s3')
        return $file;
    }
}
