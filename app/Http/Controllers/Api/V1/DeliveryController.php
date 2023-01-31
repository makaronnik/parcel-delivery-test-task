<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Response;
use App\Contracts\Delivery\DeliveryService;
use App\Requests\Api\V1\Delivery\SendRequest;
use App\Requests\Api\V1\Delivery\GetStatusRequest;

final class DeliveryController extends ApiController
{
    public function send(SendRequest $request, DeliveryService $service): string
    {
        $data = $request->validated();

        try {
            $service->send($data);
        } catch (\Throwable $exception) {
            return Response::json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'error_code' => $exception->getCode()
            ]);
        }

        return Response::json([
            'status' => 'success',
            'message' => 'Your order has been created and sent'
        ]);
    }

    public function getStatus(GetStatusRequest $request, DeliveryService $service): string
    {
        $data = $request->validated();

        try {
            return Response::json([
                'status' => $service->getStatus($data['ttn'])
            ]);

        } catch (\Throwable $exception) {
            return Response::json([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'error_code' => $exception->getCode()
            ]);
        }
    }
}
