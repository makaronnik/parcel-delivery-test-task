<?php

namespace App\Contracts\Delivery;

interface DeliveryService
{
    public function send(array $params): void;
    public function getStatus(string $ttn): string;
}
