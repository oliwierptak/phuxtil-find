<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption;

interface FormatOptionInterface
{
    public function getFormat(): string;

    public function getType(): string;
}
