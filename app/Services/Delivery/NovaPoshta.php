<?php

namespace App\Services\Delivery;

use App\Contracts\Delivery\DeliveryService;

final class NovaPoshta implements DeliveryService
{
    public function send(array $params): void
    {
        // Some code that sends a request to NavaPoshta API. Throws an exception on error
        // throw new \RuntimeException('Some API error', 500);
    }

    public function getStatus(string $ttn): string
    {
        // Some code that sends a request to NavaPoshta API. Throws an exception on error
        return 'Some status';
        // throw new \RuntimeException('Some API error', 500);
    }
}
