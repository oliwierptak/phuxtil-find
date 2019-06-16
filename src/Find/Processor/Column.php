<?php

namespace Phuxtil\Find\Processor;

use Phuxtil\Find\FormatOption\FormatOptionInterface;

class Column
{
    /**
     * @var \Phuxtil\Find\FormatOption\FormatOptionInterface
     */
    protected $formatOption;

    /**
     * @var int
     */
    protected $position;

    public function getFormatOption(): FormatOptionInterface
    {
        return $this->formatOption;
    }

    public function setFormatOption(FormatOptionInterface $formatOption): Column
    {
        $this->formatOption = $formatOption;

        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): Column
    {
        $this->position = $position;

        return $this;
    }
}
