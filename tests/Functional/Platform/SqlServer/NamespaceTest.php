<?php

namespace Ork\Crom\Tests\Functional\Platform\SqlServer;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Namespace\NamespaceNameMatchesCaseSensitiveTrait;
use Ork\Crom\Tests\Functional\Assertion\Namespace\NamespaceNameMatchesRegexTrait;

class NamespaceTest extends AbstractFunctionalTestCase
{

    use NamespaceNameMatchesCaseSensitiveTrait;
    use NamespaceNameMatchesRegexTrait;

}
