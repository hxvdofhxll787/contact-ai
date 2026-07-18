<?php

namespace App\Repositories;

use App\Models\RequestLog;

class RequestLogRepository
{
    public function create(array $data): RequestLog
    {
        return RequestLog::create($data);
    }

    public function count(): int
    {
        return RequestLog::count();
    }

    public function countFailed(): int
    {
        return RequestLog::where('status_code', '>=', 400)->count();
    }
}
