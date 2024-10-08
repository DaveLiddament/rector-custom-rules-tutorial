<?php

namespace DaveLiddament\RectorCustomRulesWorkshop\Exercise01;

class UnreachableCode
{
    public function getAge(): int
    {
        return 21;

        echo "We can not reach this code";
    }
}