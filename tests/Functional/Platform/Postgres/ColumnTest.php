<?php

namespace Ork\Crom\Tests\Functional\Platform\Postgres;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnHasDefaultTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnHasLengthTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnHasTypeTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsAutoincrementTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsForeignKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsNullableTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsPartOfForeignKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsPartOfPrimaryKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnIsPrimaryKeyTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnNameMatchesCaseInsensitiveTrait;
use Ork\Crom\Tests\Functional\Assertion\Column\ColumnNameMatchesRegexTrait;

class ColumnTest extends AbstractFunctionalTestCase
{

    use ColumnHasDefaultTrait;
    use ColumnHasLengthTrait;
    use ColumnHasTypeTrait;
    use ColumnIsAutoincrementTrait;
    use ColumnIsForeignKeyTrait;
    use ColumnIsNullableTrait;
    use ColumnIsPartOfForeignKeyTrait;
    use ColumnIsPartOfPrimaryKeyTrait;
    use ColumnIsPrimaryKeyTrait;
    use ColumnNameMatchesCaseInsensitiveTrait;
    use ColumnNameMatchesRegexTrait;

}
