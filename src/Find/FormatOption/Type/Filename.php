<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class Filename extends AbstractOption
{
    const TYPE = 'filename';

    /**
     * 0644
     *
     * @var string
     */
    protected $format = '%f';
}
