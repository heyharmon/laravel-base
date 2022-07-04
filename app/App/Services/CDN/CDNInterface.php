<?php

namespace DDD\App\Services\CDN;

interface CdnService
{
    public function purge($fileName);
}
