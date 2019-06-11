<?php

namespace Phuxtil\Find\FormatOption\Type;

class DateTime extends AbstractOption
{
    const TYPE = 'date_time';

    /**
     * 2019-06-09 20:04:56.0000 +0000
     *
     * @var string
     */
    protected $format = '%TY-%Tm-%Td %TH:%TM:%.7TS %Tz';
}
