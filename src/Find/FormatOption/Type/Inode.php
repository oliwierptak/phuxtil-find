<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class Inode extends AbstractOption
{
    const TYPE = 'inode';

    /**
     * 9979987
     *
     * @var string
     */
    protected $format = '%i';
}
