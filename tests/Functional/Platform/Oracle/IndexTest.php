<?php

namespace Ork\Crom\Tests\Functional\Platform\Oracle;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexNameMatchesCaseForcedLowerTrait;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexNameMatchesRegexTrait;

class IndexTest extends AbstractFunctionalTestCase
{

    use IndexNameMatchesCaseForcedLowerTrait;
    use IndexNameMatchesRegexTrait;

}
