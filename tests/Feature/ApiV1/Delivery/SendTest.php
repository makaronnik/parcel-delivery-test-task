<?php

namespace Tests\Feature\ApiV1\Delivery;

use Tests\TestCase;
use RuntimeException;
use Mockery\MockInterface;
use App\Contracts\Delivery\DeliveryService;

class SendTest extends TestCase
{

    public function test_success_data_validation() : void
    {
        $response = $this->post(
            uri: \route('api.v1.delivery.send'),
            data: [
                'parcel_width' => 1.23,
                'parcel_height' => 2.55,
                'parcel_length' => 5.5,
                'parcel_weight' => 10,
                'sender_full_name' => 'Тарас Григорович Шевченко',
                'sender_phone' => '0957775533',
                'sender_email' => 'sheva@gmail.com',
                'sender_address' => 'Київ, проспект Лесі Українки 77'
            ]
        );

        $response->assertOk();

        $this->assertStringContainsString(
            needle: '{"status":"success","message":"Your order has been created and sent"}',
            haystack: $response->getContent(),
        );
    }

    public function test_wrong_data_validation_fails() : void
    {
        $response = $this->post(
            uri: \route('api.v1.delivery.send'),
            data: [
                'parcel_width' => 1.231,
                'parcel_height' => 0,
                'parcel_length' => '5mm',
                'parcel_weight' => -5,
                'sender_full_name' => 'Тарас',
                'sender_phone' => 957,
                'sender_email' => 'sheva.gmail.com',
                'sender_address' => 'Київ'
            ]
        );

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'parcel_width' => 'The parcel width must have 0-2 decimal places.',
            'parcel_height' => 'The parcel height must be at least 0.1.',
            'parcel_length' => 'The parcel length must have 0-2 decimal places.',
            'parcel_weight' => 'The parcel weight must be at least 0.1.',
            'sender_full_name' => 'The sender full name must be at least 10 characters.',
            'sender_phone' => "The sender phone must be at least 10 characters.",
            'sender_email' => 'The sender email must be a valid email address.',
            'sender_address' => 'The sender address must be at least 10 characters.',
        ]);
    }

    public function test_empty_data_validation_fails() : void
    {
        $response = $this->post(
            uri: \route('api.v1.delivery.send'),
            data: []
        );

        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'parcel_width' => 'The parcel width field is required.',
            'parcel_height' => 'The parcel height field is required.',
            'parcel_length' => 'The parcel length field is required.',
            'parcel_weight' => 'The parcel weight field is required.',
            'sender_full_name' => 'The sender full name field is required.',
            'sender_phone' => "The sender phone field is required.",
            'sender_email' => 'The sender email field is required.',
            'sender_address' => 'The sender address field is required.',
        ]);
    }

    public function test_error_response_on_delivery_service_exception() : void
    {
        $this->mock(DeliveryService::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('send')
                ->once()
                ->andThrow(new RuntimeException('Some service error', 500));
        });

        $response = $this->post(
            uri: \route('api.v1.delivery.send'),
            data: [
                'parcel_width' => 1.23,
                'parcel_height' => 2.55,
                'parcel_length' => 5.5,
                'parcel_weight' => 10,
                'sender_full_name' => 'Тарас Григорович Шевченко',
                'sender_phone' => '0957775533',
                'sender_email' => 'sheva@gmail.com',
                'sender_address' => 'Київ, проспект Лесі Українки 77'
            ]
        );

        $response->assertOk();

        $this->assertStringContainsString(
            needle: '{"status":"error","message":"Some service error","error_code":500}',
            haystack: $response->getContent(),
        );
    }
}
