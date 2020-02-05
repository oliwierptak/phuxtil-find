<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class Group extends AbstractOption
{
    const TYPE = 'group';

    /**
     * root
     *
     * @var string
     */
    protected $format = '%g';
}
