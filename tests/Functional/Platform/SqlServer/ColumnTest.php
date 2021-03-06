<?php

namespace Ork\Crom\Tests\Functional\Platform\SqlServer;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnHasDefaultTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnHasLengthTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnHasLengthAtLeastTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnHasTypeTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsAutoincrementTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsForeignKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsIndexedTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsNullableTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsPartOfForeignKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsPartOfIndexTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsPartOfPrimaryKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsPrimaryKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnNameMatchesCaseTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnNameMatchesRegexTrait;

class ColumnTest extends AbstractFunctionalTestCase
{

    use ColumnHasDefaultTrait;
    use ColumnHasLengthTrait;
    use ColumnHasLengthAtLeastTrait;
    use ColumnHasTypeTrait;
    use ColumnIsAutoincrementTrait;
    use ColumnIsForeignKeyTrait;
    use ColumnIsIndexedTrait;
    use ColumnIsNullableTrait;
    use ColumnIsPartOfForeignKeyTrait;
    use ColumnIsPartOfIndexTrait;
    use ColumnIsPartOfPrimaryKeyTrait;
    use ColumnIsPrimaryKeyTrait;
    use ColumnNameMatchesCaseTrait;
    use ColumnNameMatchesRegexTrait;

}
