<?php

namespace DaveLiddament\RectorCustomRulesWorkshop\Exercise05;


function lookupName(LookupService $lookupService): mixed
{
    return $lookupService->lookup('name');
}