<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class Permissions extends AbstractOption
{
    const TYPE = 'permissions';

    /**
     * 0644
     *
     * @var string
     */
    protected $format = '%#m';
}
