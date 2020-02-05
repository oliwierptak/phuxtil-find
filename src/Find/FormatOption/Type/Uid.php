<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class Uid extends AbstractOption
{
    const TYPE = 'uid';

    /**
     * 0
     *
     * @var string
     */
    protected $format = '%U';
}
