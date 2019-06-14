<?php

namespace Phuxtil\Find\Processor;

use Phuxtil\Chmod\ChmodFacade;
use Phuxtil\Find\DefinesInterface;
use Phuxtil\Find\FindConfigurator;
use Phuxtil\Find\Output\Column;
use Phuxtil\SplFileInfo\VirtualSplFileInfo;

class OptionProcessor
{
    /**
     * @var ChmodFacade
     */
    protected $chmodFacade;

    /**
     * @var \Phuxtil\Find\FormatOption\FormatOptionInterface[]
     */
    protected $options = [];

    public function __construct(ChmodFacade $chmodFacade, array $options)
    {
        $this->chmodFacade = $chmodFacade;
        $this->options = $options;
    }

    public function process(FindConfigurator $configurator): array
    {
        $definedOptions = \explode($configurator->getFormatDelimiter(), trim($configurator->getFormat()));
        $columns = $this->processColumns($definedOptions);

        $lines = \explode($configurator->getLineDelimiter(), trim($configurator->getFindOutput()));
        $result = $this->processLines($columns, $lines, $configurator->getFormatDelimiter());
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

    protected function processLines(array $columns, array $lines, string $delimiter): array
    {
        $result = [];
        for ($lineNumber = 0; $lineNumber < count($lines); $lineNumber++) {
            $values = \explode($delimiter, trim($lines[$lineNumber]));

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

            $itemData['file'] = $itemData['type'] === DefinesInterface::TYPE_FILE;
            $itemData['dir'] = $itemData['type'] === DefinesInterface::TYPE_DIR;
            $itemData['link'] = $itemData['type'] === DefinesInterface::TYPE_LINK;

            $perms = $itemData['permissions'];
            $itemData['perms'] = $perms;
            $itemData['readable'] = $this->chmodFacade->isReadable($perms);
            $itemData['writable'] = $this->chmodFacade->isWritable($perms);
            $itemData['executable'] = $this->chmodFacade->isExecutable($perms);
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
            DefinesInterface::TYPE_DIR => 'directory',
            DefinesInterface::TYPE_FILE => 'file',
            DefinesInterface::TYPE_LINK => 'link',
        ];

        return $mappings[$type] ?? 'unknown';
    }
}
