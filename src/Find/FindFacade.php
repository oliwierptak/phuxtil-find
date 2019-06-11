<?php

namespace Phuxtil\Find;

class FindFacade
{
    /**
     * @var \Phuxtil\Find\FindFacade
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

    /**
     * '%TY-%Tm-%Td %TH:%TM:%.7TS %Tz|%As|%Cs|%Ts|%#m|%u|%g|%U|%G|%y|%i|%b|%s|%n|%f|%p'\n
     *
     * @param string $input
     *
     * @return mixed
     */
    public function process(string $input): array
    {
        return $this->getFactory()
            ->createFormatOptionProcessor()
            ->process($input);
    }
}
