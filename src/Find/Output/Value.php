<?php

namespace Phuxtil\Find\Output;

class Value
{
    /**
     * @var \Phuxtil\Find\Output\Column
     */
    protected $column;

    /**
     * @var string
     */
    protected $value;

    public function getColumn(): Column
    {
        return $this->column;
    }

    public function setColumn(Column $column): Value
    {
        $this->column = $column;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): Value
    {
        $this->value = $value;

        return $this;
    }
}
