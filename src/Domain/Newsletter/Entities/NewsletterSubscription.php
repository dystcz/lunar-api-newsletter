<?php

namespace Dystcz\LunarNewsletter\Domain\Newsletter\Entities;

use Illuminate\Contracts\Support\Arrayable;

class NewsletterSubscription implements Arrayable
{
    public function __construct(
        public string $email,
    ) {
    }

    /**
     * Create a new site entity from an array.
     *
     * @return Site
     */
    public static function fromArray(string $email)
    {
        return new self($email);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'email' => $this->email,
        ];
    }
}
