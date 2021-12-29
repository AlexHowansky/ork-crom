<?php

namespace Ork\Crom\Tests\Functional\Platform\Sqlite;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexIsUniqueTrait;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexNameMatchesCaseTrait;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexNameMatchesRegexTrait;

class IndexTest extends AbstractFunctionalTestCase
{

    use IndexIsUniqueTrait;
    use IndexNameMatchesCaseTrait;
    use IndexNameMatchesRegexTrait;

}
