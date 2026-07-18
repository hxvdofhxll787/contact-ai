<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Contact API",
    version: "1.0.0",
    description: "API for developer landing page contact form"
)]
#[OA\Server(
    url: "http://localhost:8000",
    description: "Local server"
)]
class OpenApiSpec
{

}
