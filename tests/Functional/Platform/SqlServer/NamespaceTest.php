<?php

namespace Ork\Crom\Tests\Functional\Platform\SqlServer;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Namespace\NamespaceNameMatchesCaseTrait;
use Ork\Crom\Tests\Functional\Assertion\Namespace\NamespaceNameMatchesRegexTrait;

class NamespaceTest extends AbstractFunctionalTestCase
{

    use NamespaceNameMatchesCaseTrait;
    use NamespaceNameMatchesRegexTrait;

}
