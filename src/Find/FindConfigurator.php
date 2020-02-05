<?php

declare(strict_types = 1);

namespace Phuxtil\Find;

class FindConfigurator
{
    /**
     * @var string
     */
    protected $format = DefinesInterface::DEFAULT_FORMAT;

    /**
     * @var string
     */
    protected $formatDelimiter = DefinesInterface::DEFAULT_FORMAT_DELIMITER;

    /**
     * @var string
     */
    protected $lineDelimiter = DefinesInterface::DEFAULT_LINE_DELIMITER;

    /**
     * @var string
     */
    protected $findOutput = '';

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(string $format): FindConfigurator
    {
        $this->format = $format;

        return $this;
    }

    public function getFormatDelimiter(): string
    {
        return $this->formatDelimiter;
    }

    public function setFormatDelimiter(string $formatDelimiter): FindConfigurator
    {
        $this->formatDelimiter = $formatDelimiter;

        return $this;
    }

    public function getLineDelimiter(): string
    {
        return $this->lineDelimiter;
    }

    public function setLineDelimiter(string $lineDelimiter): FindConfigurator
    {
        $this->lineDelimiter = $lineDelimiter;

        return $this;
    }

    public function getFindOutput(): string
    {
        return $this->findOutput;
    }

    public function setFindOutput(string $findOutput): FindConfigurator
    {
        $this->findOutput = $findOutput;

        return $this;
    }
}
