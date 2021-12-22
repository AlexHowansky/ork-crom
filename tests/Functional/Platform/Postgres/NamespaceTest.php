<?php

namespace Ork\Crom\Tests\Functional\Platform\Postgres;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Namespace\NamespaceNameMatchesCaseForcedLowerTrait;
use Ork\Crom\Tests\Functional\Assertion\Namespace\NamespaceNameMatchesRegexTrait;

class NamespaceTest extends AbstractFunctionalTestCase
{

    use NamespaceNameMatchesCaseForcedLowerTrait;
    use NamespaceNameMatchesRegexTrait;

}
