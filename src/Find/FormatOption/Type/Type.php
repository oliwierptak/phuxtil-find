<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class Type extends AbstractOption
{
    const TYPE = 'type';

    /**
     * f|d|l
     *
     * @var string
     */
    protected $format = '%y';
}
