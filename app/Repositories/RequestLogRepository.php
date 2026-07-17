<?php

namespace App\Repositories;

use App\Models\RequestLog;

class RequestLogRepository
{
    public function create(array $data): RequestLog
    {
        return RequestLog::create($data);
    }
}
