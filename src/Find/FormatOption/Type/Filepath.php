<?php

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
