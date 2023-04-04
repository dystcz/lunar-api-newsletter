<?php

namespace Dystcz\LunarNewsletter\Domain\Newsletter\JsonApi\V1;

use Illuminate\Http\Request;
use LaravelJsonApi\Core\Resources\JsonApiResource;

class NewsletterSubscriptionResource extends JsonApiResource
{
    /**
     * Get the resource id.
     */
    public function id(): string
    {
        return 'newsletter';
    }

    /**
     * Get the resource's attributes.
     *
     * @param  Request|null  $request
     */
    public function attributes($request): iterable
    {
        return [
            'email' => $this->email,
        ];
    }

    /**
     * Get the resource's relationships.
     *
     * @param  Request|null  $request
     */
    public function relationships($request): iterable
    {
        return [
            //
        ];
    }
}
