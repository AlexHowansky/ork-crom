<?php

namespace Ork\Crom\Tests\Functional\Platform\Postgres;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexIsUniqueTrait;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexNameMatchesCaseForcedLowerTrait;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexNameMatchesRegexTrait;

class IndexTest extends AbstractFunctionalTestCase
{

    use IndexIsUniqueTrait;
    use IndexNameMatchesCaseForcedLowerTrait;
    use IndexNameMatchesRegexTrait;

}
