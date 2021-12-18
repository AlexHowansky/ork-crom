<?php

namespace Ork\Crom\Tests\Functional\Platform\Postgres;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Table\TableHasPrimaryKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesCaseInsensitiveTrait;
use Ork\Crom\Tests\Functional\Assertion\Table\TableNameMatchesRegexTrait;

class TableTest extends AbstractFunctionalTestCase
{

    use TableHasPrimaryKeyTrait;
    use TableNameMatchesCaseInsensitiveTrait;
    use TableNameMatchesRegexTrait;

}
