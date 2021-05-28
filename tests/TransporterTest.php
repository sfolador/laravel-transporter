<?php

declare(strict_types=1);

namespace JustSteveKing\Transporter\Tests;

use Illuminate\Support\Facades\Http;
use JustSteveKing\Transporter\Tests\Stubs\TestRequest;
use JustSteveKing\Transporter\Transporter;
use JustSteveKing\Transporter\Tests\TestCase;

class TransporterTest extends TestCase
{
    protected Transporter $transporter;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_builds_a_transporter()
    {
        $pool = Transporter::request(TestRequest::for('1'))->dispatch();

        dd($pool);
    }

    /**
     * @test
     */
    public function it_can_create_a_new_api_request_using_the_command()
    {
        $this->assertTrue(
            file_exists(
                __DIR__ . '/../stubs/api-request.stub'
            )
        );

        $this->artisan(
            command: 'make:api-request TestRequest',
        )->assertExitCode(
            exitCode: 0,
        );

        $this->assertTrue(
            file_exists(
                __DIR__ . '/../vendor/orchestra/testbench-core/laravel/app/Transporter/Requests/TestRequest.php'
            )
        );
    }
}
