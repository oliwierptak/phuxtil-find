<?php

declare(strict_types = 1);

namespace Phuxtil\Find\FormatOption;

use Phuxtil\Find\FormatOption\Type\Blocks;
use Phuxtil\Find\FormatOption\Type\DateAccess;
use Phuxtil\Find\FormatOption\Type\DateChange;
use Phuxtil\Find\FormatOption\Type\DateModify;
use Phuxtil\Find\FormatOption\Type\Filename;
use Phuxtil\Find\FormatOption\Type\Filepath;
use Phuxtil\Find\FormatOption\Type\Gid;
use Phuxtil\Find\FormatOption\Type\Group;
use Phuxtil\Find\FormatOption\Type\Inode;
use Phuxtil\Find\FormatOption\Type\Links;
use Phuxtil\Find\FormatOption\Type\Permissions;
use Phuxtil\Find\FormatOption\Type\Size;
use Phuxtil\Find\FormatOption\Type\Type;
use Phuxtil\Find\FormatOption\Type\Uid;
use Phuxtil\Find\FormatOption\Type\User;

class FormatOptionContainer
{
    protected $optionClasses = [
        Blocks::class,
        DateAccess::class,
        DateModify::class,
        DateChange::class,
        Filename::class,
        Filepath::class,
        Gid::class,
        Group::class,
        Inode::class,
        Links::class,
        Permissions::class,
        Size::class,
        Type::class,
        Uid::class,
        User::class,
    ];

    /**
     * @return \Phuxtil\Find\FormatOption\FormatOptionInterface[]
     */
    public function collect(): array
    {
        return $this->optionClasses;
    }
}
