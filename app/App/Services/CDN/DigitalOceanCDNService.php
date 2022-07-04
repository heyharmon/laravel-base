<?php

namespace DDD\App\Services\CDN;

use Illuminate\Support\Facades\Http;

class DOCdnService implements CdnService
{

    public function purge($fileName)
    {
        $folder = config('filesystems.do.folder');

        Http::asJson()->delete(
            config('filesystems.do.cdn_endpoint') . '/cache',
            [
                'files' => ["{$folder}/{$fileName}"],
            ]
        );
    }
}
