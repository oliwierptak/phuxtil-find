<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class Gid extends AbstractOption
{
    const TYPE = 'gid';

    /**
     * 0
     *
     * @var string
     */
    protected $format = '%G';
}
