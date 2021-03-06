<?php

declare(strict_types = 1);

namespace Phuxtil\Find;

interface FindFacadeInterface
{
    public function setFactory(FindFactory $factory);

    /**
     * @param \Phuxtil\Find\FindConfigurator $configurator
     *
     * @return \Phuxtil\SplFileInfo\VirtualSplFileInfo[]
     */
    public function process(FindConfigurator $configurator): array;
}
