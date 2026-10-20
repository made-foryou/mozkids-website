<?php

declare(strict_types=1);

namespace Tests\Unit\Domains\Newsletter;

use MailchimpMarketing\ApiClient;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MailchimpClientTest extends TestCase
{
    #[Test]
    public function it_uses_the_configured_server_prefix(): void
    {
        config([
            'services.mailchimp.api_key' => 'abc123-us21',
            'services.mailchimp.server_prefix' => 'us6',
        ]);

        self::assertSame('https://us6.api.mailchimp.com/3.0', app(ApiClient::class)->getHost());
    }

    #[Test]
    public function it_derives_the_server_prefix_from_the_api_key_when_it_is_empty(): void
    {
        config([
            'services.mailchimp.api_key' => 'abc123-us21',
            'services.mailchimp.server_prefix' => '',
        ]);

        self::assertSame('https://us21.api.mailchimp.com/3.0', app(ApiClient::class)->getHost());
    }

    #[Test]
    public function it_limits_the_request_timeout(): void
    {
        self::assertSame(10, app(ApiClient::class)->getTimeout());
    }
}
