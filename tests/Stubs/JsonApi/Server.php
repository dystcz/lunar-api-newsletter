<?php

namespace Dystcz\LunarApiNewsletter\Tests\Stubs\JsonApi;

use Dystcz\LunarApi\Domain\JsonApi\V1\Server as BaseServer;
use Dystcz\LunarApiNewsletter\Domain\Newsletter\JsonApi\V1\NewsletterSchema;

class Server extends BaseServer
{
    /**
     * Get the server's list of schemas.
     */
    protected function allSchemas(): array
    {
        return [
            NewsletterSchema::class,
        ];
    }
}
