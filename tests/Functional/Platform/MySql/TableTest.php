<?php

namespace Ork\Crom\Tests\Functional\Platform\MySql;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Table\TableHasPrimaryKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesCaseSensitiveTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesRegexTrait;

class TableTest extends AbstractFunctionalTestCase
{

    use TableHasPrimaryKeyTrait;
    use TableNameMatchesCaseSensitiveTrait;
    use TableNameMatchesRegexTrait;

}
