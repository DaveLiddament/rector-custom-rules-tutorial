<?php

namespace DaveLiddament\RectorCustomRulesWorkshop\Exercise05;

class LookupService {
    public function lookup(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }
}

?>
-----
<?php

namespace DaveLiddament\RectorCustomRulesWorkshop\Exercise05;

class LookupService {
    public function lookup(string $key, mixed $default): mixed
    {
        return $this->values[$key] ?? null;
    }
}

?>
