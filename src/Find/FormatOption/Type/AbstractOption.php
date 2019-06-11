<?php

namespace Phuxtil\Find\FormatOption\Type;

use Phuxtil\Find\FormatOption\FormatOptionInterface;

abstract class AbstractOption implements FormatOptionInterface
{
    const TYPE = '';

    /**
     * @var string
     */
    protected $format = '';

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getType(): string
    {
        return static::TYPE;
    }
}
