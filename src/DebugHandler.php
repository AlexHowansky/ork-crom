<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom;

use Monolog\Handler\Handler;
use Monolog\Logger;
use Monolog\LogRecord;
use Ork\Crom\Asset\ColumnAsset;
use Ork\Crom\Asset\IndexAsset;
use Ork\Crom\Asset\NamespaceAsset;
use Ork\Crom\Asset\TableAsset;
use RuntimeException;

/**
 * A Monolog handler to dump debugging information.
 */
class DebugHandler extends Handler
{

    /**
     * Dump column information.
     *
     * @param ColumnAsset $asset The column to dump.
     *
     * @return void
     */
    protected function dumpColumn(ColumnAsset $asset): void
    {
        $table = $asset->getTable();
        $column = $asset->getColumn();
        echo "column\n";
        printf("  namespace: %s\n", $table->getNamespaceName());
        printf("  table: %s\n", $table->getShortestName($table->getNamespaceName()));
        printf("  column: %s\n", $column->getName());
        printf("  type: %s\n", $column->getType()->getName());
        printf("  default: %s\n", $column->getDefault());
        printf("  nullable: %s\n", $column->getNotnull() === true ? 'no' : 'yes');
        printf("  autoincrement: %s\n", $column->getAutoincrement() === true ? 'yes' : 'no');
        printf("  signed: %s\n", $column->getUnsigned() === true ? 'no' : 'yes');
        printf("  fixed: %s\n", $column->getFixed() === true ? 'yes' : 'no');
        printf("  length: %s\n", $column->getLength());
        printf("  precision: %s\n", $column->getPrecision());
        printf("  scale: %s\n", $column->getScale());
        printf("  comment: %s\n", $column->getComment());
        echo "\n";
    }

    /**
     * Dump index information.
     *
     * @param IndexAsset $asset The index to dump.
     *
     * @return void
     */
    protected function dumpIndex(IndexAsset $asset): void
    {
        $table = $asset->getTable();
        $index = $asset->getIndex();
        echo "index\n";
        printf("  namespace: %s\n", $table->getNamespaceName());
        printf("  table: %s\n", $table->getShortestName($table->getNamespaceName()));
        printf("  index: %s\n", $index->getName());
        printf("  primary: %s\n", $index->isPrimary() === true ? 'yes' : 'no');
        printf("  unique: %s\n", $index->isUnique() === true ? 'yes' : 'no');
        printf("  columns: %s\n", implode(', ', $index->getColumns()));
        echo "\n";
    }

    /**
     * Dump namespace information.
     *
     * @param NamespaceAsset $asset The namespace to dump.
     *
     * @return void
     */
    protected function dumpNamespace(NamespaceAsset $asset): void
    {
        echo "namespace\n";
        printf("  namespace: %s\n", $asset->getName());
        echo "\n";
    }

    /**
     * Dump table information.
     *
     * @param TableAsset $asset The table to dump.
     *
     * @return void
     */
    protected function dumpTable(TableAsset $asset): void
    {
        $table = $asset->getTable();
        echo "table\n";
        printf("  namespace: %s\n", $table->getNamespaceName());
        printf("  table: %s\n", $table->getShortestName($table->getNamespaceName()));
        echo "  primary key columns:\n";
        if ($table->hasPrimaryKey() === true) {
            foreach ($table->getPrimaryKeyColumns() as $column) {
                printf("    %s [%s]\n", $column->getName(), $column->getType()->getName());
            }
        }
        echo "  foreign keys:\n";
        foreach ($table->getForeignKeys() as $fkey) {
            printf(
                "    %s: %s -> %s (%s)\n",
                $fkey->getName(),
                implode(', ', $fkey->getLocalColumns()),
                $fkey->getForeignTableName(),
                implode(', ', $fkey->getForeignColumns())
            );
        }
        echo "  indexes:\n";
        foreach ($table->getIndexes() as $index) {
            printf(
                "    %s: %s%s\n",
                $index->getName(),
                $index->isUnique() === true ? '[UNIQUE] ' : '',
                implode(', ', $index->getColumns())
            );
        }
        printf("  comment: %s\n", $table->getComment());
        echo "\n";
    }

    /**
     * {@inheritDoc}
     *
     * @throws RuntimeException If an unknown asset type is encountered.
     */
    public function handle(LogRecord $record): bool
    {
        if (isset($record['context']['asset']) === false) {
            return false;
        }
        switch ($record['context']['asset']::class) {
            case ColumnAsset::class:
                $this->dumpColumn($record['context']['asset']);
                break;

            case IndexAsset::class:
                $this->dumpIndex($record['context']['asset']);
                break;

            case NamespaceAsset::class:
                $this->dumpNamespace($record['context']['asset']);
                break;

            case TableAsset::class:
                $this->dumpTable($record['context']['asset']);
                break;

            default:
                throw new RuntimeException('Unknown asset');
        }
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isHandling(LogRecord $record): bool
    {
        return $record['level'] <= Logger::DEBUG;
    }

}
