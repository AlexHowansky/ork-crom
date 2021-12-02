<?php

namespace Ork\Crom\Tests\Unit\Asset;

use Doctrine\DBAL\Schema\Table;
use Ork\Crom\Asset\TableAsset;
use PHPUnit\Framework\TestCase;

class TableAssetTest extends TestCase
{

    public function testAsset(): void
    {
        $name = md5(random_bytes(32));
        $table = new Table($name);
        $asset = new TableAsset($table);
        $this->assertSame($name, $asset->getLabel());
        $this->assertSame($name, $asset->getName());
        $this->assertSame($table, $asset->getTable());
        $this->assertSame('table', $asset->getType());
    }

}
