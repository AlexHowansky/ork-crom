# `columnIsForeignKey`

Asserts that a column is a foreign key.

## Description

This assertion will pass if the column is a simple foreign key. The assertion
will fail if the column is part of a composite foreign key. For that case, use
the [`columnIsPartOfForeignKey`](ColumnIsPartOfForeignKey.md) assertion. If the
optional `toTable` or `toColumn` parameters are specified, the assertion will
pass only if the foreign key links to the specified table and/or column.

### Parameters

|Name|Required|Description|
|:-|:-|:-|
|`toTable`|no||
|`toColumn`|no||

#### Examples

```yaml
-
    assertion: columnIsForeignKey
```

```yaml
-
    assertion: columnIsForeignKey
    toTable: customer
```

```yaml
-
    assertion: columnIsForeignKey
    toTable: customer
    toColumn: id
```
