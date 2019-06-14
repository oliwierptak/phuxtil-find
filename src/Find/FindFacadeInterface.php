<?php

namespace Phuxtil\Find;

interface FindFacadeInterface
{
    public function setFactory(FindFactory $factory);

    /**
     * @param \Phuxtil\Find\FindConfigurator $configurator
     *
     * @return mixed
     */
    public function process(FindConfigurator $configurator): array;

    public function getDefaultFormat(): string;
}
