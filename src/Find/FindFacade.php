<?php

namespace Phuxtil\Find;

class FindFacade implements FindFacadeInterface
{
    /**
     * @var \Phuxtil\Find\FindFactory
     */
    protected $factory;

    protected function getFactory(): FindFactory
    {
        if ($this->factory === null) {
            $this->factory = new FindFactory();
        }

        return $this->factory;
    }

    public function setFactory(FindFactory $factory)
    {
        $this->factory = $factory;
    }

    public function process(FindConfigurator $configurator): array
    {
        return $this->getFactory()
            ->createFormatOptionProcessor()
            ->process($configurator);
    }
}
