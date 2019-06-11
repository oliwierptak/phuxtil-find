<?php

namespace Phuxtil\Find\Processor;

use Phuxtil\Chmod\ChmodFacade;
use Phuxtil\Find\Output\Column;
use Phuxtil\SplFileInfo\VirtualSplFileInfo;

class OptionProcessor
{
    const TYPE_FILE = 'f';
    const TYPE_DIR = 'd';
    const TYPE_LINK = 'l';

    /**
     * @var \Phuxtil\Find\FormatOption\FormatOptionInterface[]
     */
    protected $options;

    /**
     * @var string
     */
    protected $format;

    /**
     * @var string
     */
    protected $delimiter;

    /**
     * @param string $format
     * @param \Phuxtil\Find\FormatOption\FormatOptionInterface[] $options
     * @param string $delimiter
     */
    public function __construct(string $format, array $options, string $delimiter)
    {
        $this->options = $options;
        $this->format = $format;
        $this->delimiter = $delimiter;
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
        $definedOptions = \explode($this->delimiter, trim($this->format));
        $columns = $this->processColumns($definedOptions);

        $lines = \explode(\PHP_EOL, trim($input));
        $result = $this->processLines($columns, $lines);
        $result = $this->toSplFileInfoFormat($result);

        return $result;
    }

    protected function processColumns(array $definedOptions): array
    {
        $result = [];

        for ($columnNumber = 0; $columnNumber < count($definedOptions); $columnNumber++) {
            foreach ($this->options as $type => $formatOption) {
                /**
                 * @var \Phuxtil\Find\FormatOption\FormatOptionInterface $formatOption
                 */
                if ($definedOptions[$columnNumber] !== $formatOption->getFormat()
                    || $formatOption->getType() !== $type) {
                    continue;
                }

                $column = (new Column())
                    ->setPosition($columnNumber)
                    ->setFormatOption($formatOption);

                $result[$type] = $column;
            }
        }

        return $result;
    }

    protected function processLines(array $columns, array $lines): array
    {
        $result = [];
        for ($lineNumber = 0; $lineNumber < count($lines); $lineNumber++) {
            $values = \explode($this->delimiter, trim($lines[$lineNumber]));

            $item = \array_combine(
                \array_keys($columns),
                \array_values($values)
            );

            $result[] = $item;
        }

        return $result;
    }

    protected function toSplFileInfoFormat(array $data): array
    {
        $result = [];
        for ($a = 0; $a < count($data); $a++) {
            $itemData = $data[$a];

            $itemData['path'] = \pathinfo($itemData['filepath'], \PATHINFO_DIRNAME);
            $itemData['basename'] = \pathinfo($itemData['filepath'], \PATHINFO_BASENAME);
            $itemData['extension'] = \pathinfo($itemData['filepath'], \PATHINFO_EXTENSION);
            $itemData['realPath'] = $itemData['filepath'];

            $itemData['aTime'] = $itemData['date_access'];
            $itemData['mTime'] = $itemData['date_modify'];
            $itemData['cTime'] = $itemData['date_change'];

            $itemData['file'] = $itemData['type'] === static::TYPE_FILE;
            $itemData['dir'] = $itemData['type'] === static::TYPE_DIR;
            $itemData['link'] = $itemData['type'] === static::TYPE_LINK;

            $chmodFacade = new ChmodFacade();
            $perms = $itemData['permissions'];
            $itemData['perms'] = $perms;
            $itemData['readable'] = $chmodFacade->validateByOctal($perms, 'u', 'r');
            $itemData['writable'] = $chmodFacade->validateByOctal($perms, 'u', 'w');
            $itemData['executable'] = $chmodFacade->validateByOctal($perms, 'u', 'x');
            $itemData['owner'] = $itemData['uid'];
            $itemData['group'] = $itemData['gid'];
            $itemData['type'] = $this->typeToSplFileType($itemData['type']);

            $virtualSplFileInfo = (new VirtualSplFileInfo($itemData['filepath']))
                ->fromArray($itemData);

            $result[] = $virtualSplFileInfo;
        }

        return $result;
    }

    protected function typeToSplFileType(string $type): string
    {
        $mappings = [
            static::TYPE_DIR => 'directory',
            static::TYPE_FILE => 'file',
            static::TYPE_LINK => 'link',
        ];

        return $mappings[$type] ?? 'unknown';
    }
}
