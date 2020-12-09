<?php

namespace Core\Attributes;

use Attribute;

#[Attribute]
class ListensTo
{

    /**
     * ListenTo constructor.
     * @param string $event
     */
    public function __construct(
        public string $event
    ){}
}