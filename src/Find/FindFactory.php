<?php

namespace Phuxtil\Find;

use Phuxtil\Chmod\ChmodFacade;
use Phuxtil\Find\FormatOption\FormatOptionContainer;
use Phuxtil\Find\Processor\OptionProcessor;

class FindFactory
{
    public function createFormatOptionProcessor(): OptionProcessor
    {
        return new OptionProcessor(
            $this->createChmodFacade(),
            $this->createOptionCollection()
        );
    }

    protected function createOptionCollection(): array
    {
        $result = [];
        $optionClasses = $this->createOptionContainer()->collect();

        foreach ($optionClasses as $optionClassName) {
            /**
             * @var \Phuxtil\Find\FormatOption\FormatOptionInterface $option
             */
            $option = new $optionClassName();
            $result[$option->getType()] = $option;
        }

        return $result;
    }

    protected function createOptionContainer(): FormatOptionContainer
    {
        return new FormatOptionContainer();
    }

    protected function createChmodFacade()
    {
        return new ChmodFacade();
    }
}
