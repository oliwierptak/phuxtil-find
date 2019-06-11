<?php

namespace Phuxtil\Find\FormatOption\Type;

class User extends AbstractOption
{
    const TYPE = 'user';

    /**
     * root
     *
     * @var string
     */
    protected $format = '%u';
}
