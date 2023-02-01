<?php

namespace Tests\Feature\ApiV1\Delivery;

use RuntimeException;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Contracts\Delivery\DeliveryService;

class StatusTest extends TestCase
{

    public function test_success_data_validation() : void
    {
        $response = $this->get(\route('api.v1.delivery.get_status', ['ttn' => 1234567890]));

        $response->assertOk();

        $this->assertStringContainsString(
            needle: '{"status":"Some status"}',
            haystack: $response->getContent(),
        );
    }

    public function test_wrong_data_validation_fails() : void
    {
        $response = $this->get(\route('api.v1.delivery.get_status', ['ttn' => 1234567]));

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['ttn' => 'The ttn must be at least  10 characters.']);
    }

    public function test_empty_data_validation_fails() : void
    {
        $response = $this->get(\route('api.v1.delivery.get_status'));

        $response->assertStatus(302);

        $response->assertSessionHasErrors(['ttn' => 'The ttn field is required.']);
    }

    public function test_error_response_on_delivery_service_exception() : void
    {
        $this->mock(DeliveryService::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('getStatus')
                ->once()
                ->andThrow(new RuntimeException('Some service error', 500));
        });

        $response = $this->get(\route('api.v1.delivery.get_status', ['ttn' => 1234567890]));

        $response->assertOk();

        $this->assertStringContainsString(
            needle: '{"status":"error","message":"Some service error","error_code":500}',
            haystack: $response->getContent(),
        );
    }
}
