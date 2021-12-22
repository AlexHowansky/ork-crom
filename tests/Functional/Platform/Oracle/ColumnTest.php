<?php

namespace Ork\Crom\Tests\Functional\Platform\OracleDb;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnHasDefaultTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsNullableTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnNameMatchesCaseForcedUpperTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnNameMatchesRegexTrait;

class ColumnTest extends AbstractFunctionalTestCase
{

    use ColumnHasDefaultTrait;
    use ColumnIsNullableTrait;
    use ColumnNameMatchesCaseForcedUpperTrait;
    use ColumnNameMatchesRegexTrait;

}
