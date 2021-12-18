<?php

namespace Ork\Crom\Tests\Functional\Platform\Postgres;

use Ork\Crom\Tests\Functional\AbstractFunctionalTestCase;
use Ork\Crom\Tests\Functional\Assertion\Namespace\NamespaceNameMatchesCaseInsensitiveTrait;
use Ork\Crom\Tests\Functional\Assertion\Namespace\NamespaceNameMatchesRegexTrait;

class NamespaceTest extends AbstractFunctionalTestCase
{

    use NamespaceNameMatchesCaseInsensitiveTrait;
    use NamespaceNameMatchesRegexTrait;

}
