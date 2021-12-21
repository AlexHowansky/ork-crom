<?php

namespace Ork\Crom\Tests\Functional\Platform\Postgres;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Table\TableHasPrimaryKeyForcedLowerTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesCaseForcedLowerTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesRegexForcedLowerTrait;

class TableTest extends AbstractFunctionalTestCase
{

    use TableHasPrimaryKeyForcedLowerTrait;
    use TableNameMatchesCaseForcedLowerTrait;
    use TableNameMatchesRegexForcedLowerTrait;

}
