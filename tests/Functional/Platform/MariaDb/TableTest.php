<?php

namespace Ork\Crom\Tests\Functional\Platform\MariaDb;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Table\TableHasIndexTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableHasPrimaryKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesCaseTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesRegexTrait;

class TableTest extends AbstractFunctionalTestCase
{

    use TableHasIndexTrait;
    use TableHasPrimaryKeyTrait;
    use TableNameMatchesCaseTrait;
    use TableNameMatchesRegexTrait;

}
