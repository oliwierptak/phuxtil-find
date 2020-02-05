<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class Filepath extends AbstractOption
{
    const TYPE = 'filepath';

    /**
     * 0644
     *
     * @var string
     */
    protected $format = '%p';
}
