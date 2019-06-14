<?php

namespace Phuxtil\Find;

interface DefinesInterface
{
    const DEFAULT_FORMAT = "%As|%Cs|%Ts|%#m|%u|%g|%U|%G|%y|%i|%b|%s|%n|%f|%p";
    const DEFAULT_FORMAT_DELIMITER = '|';
    const DEFAULT_LINE_DELIMITER = \PATH_SEPARATOR;

    const TYPE_FILE = 'f';
    const TYPE_DIR = 'd';
    const TYPE_LINK = 'l';
}
