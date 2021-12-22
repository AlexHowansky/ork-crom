<?php

namespace Ork\Crom\Tests\Functional\Platform\SqlServer;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexNameMatchesCaseTrait;
use Ork\Crom\Tests\Functional\Assertion\Index\IndexNameMatchesRegexTrait;

class IndexTest extends AbstractFunctionalTestCase
{

    use IndexNameMatchesCaseTrait;
    use IndexNameMatchesRegexTrait;

}
