<?php

namespace DDD\Http\Base\Files;

use DDD\Domain\Base\Files\File;
use DDD\App\Controllers\Controller;

class FileDownloadController extends Controller
{
    public function download(File $file)
    {
        return $file;
    }
}
