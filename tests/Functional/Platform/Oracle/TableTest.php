<?php

namespace Ork\Crom\Tests\Functional\Platform\OracleDb;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Table\TableHasPrimaryKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesCaseForcedUpperTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesRegexTrait;

class TableTest extends AbstractFunctionalTestCase
{

    use TableHasPrimaryKeyTrait;
    use TableNameMatchesCaseForcedUpperTrait;
    use TableNameMatchesRegexTrait;

}
