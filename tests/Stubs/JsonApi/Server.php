<?php

namespace Dystcz\LunarNewsletter\Tests\Stubs\JsonApi;

use Dystcz\LunarApi\Domain\JsonApi\V1\Server as BaseServer;
use Dystcz\LunarNewsletter\Domain\Newsletter\JsonApi\V1\NewsletterSchema;
use Dystcz\LunarNewsletter\Tests\Stubs\Users\UserSchema;

class Server extends BaseServer
{
    /**
     * Get the server's list of schemas.
     */
    protected function allSchemas(): array
    {
        return [
            // UserSchema::class,
            NewsletterSchema::class,
        ];
    }
}
