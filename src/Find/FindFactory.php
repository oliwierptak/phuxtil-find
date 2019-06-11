<?php

namespace Phuxtil\Find;

use Phuxtil\Find\FormatOption\FormatOptionContainer;
use Phuxtil\Find\Processor\OptionProcessor;

class FindFactory
{
    /**
     * "%TY-%Tm-%Td %TH:%TM:%.7TS %Tz|%As|%Cs|%Ts|%#m|%u|%g|%U|%G|%y|%i|%b|%s|%n|%f|%p\n"
     *
     * @param string $format
     * @param string $delimiter
     *
     * @return \Phuxtil\Find\Processor\OptionProcessor
     */
    public function createFormatOptionProcessor(string $format = '', string $delimiter = '|'): OptionProcessor
    {
        if (trim($format) === '') {
            $format = "%TY-%Tm-%Td %TH:%TM:%.7TS %Tz|%As|%Cs|%Ts|%#m|%u|%g|%U|%G|%y|%i|%b|%s|%n|%f|%p\n";
        }

        if (trim($delimiter) === '') {
            $delimiter = '|';
        }

        return new OptionProcessor(
            $format,
            $this->createOptionCollection(),
            $delimiter
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
}
