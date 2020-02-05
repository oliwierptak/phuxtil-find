<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class Blocks extends AbstractOption
{
    const TYPE = 'blocks';

    /**
     * root
     *
     * @var string
     */
    protected $format = '%b';
}
