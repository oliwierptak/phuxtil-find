<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption\Type;

class DateModify extends AbstractOption
{
    const TYPE = 'date_modify';

    /**
     * 1560112579
     *
     * @var string
     */
    protected $format = '%Ts';
}
