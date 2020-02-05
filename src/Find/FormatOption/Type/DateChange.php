<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class DateChange extends AbstractOption
{
    const TYPE = 'date_change';

    /**
     * 1560112579
     *
     * @var string
     */
    protected $format = '%Cs';
}
