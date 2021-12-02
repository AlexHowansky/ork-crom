# `columnIsPartOfForeignKey`

Asserts that a column is part of a foreign key.

## Description

This assertion will pass if the column is a simple foreign key or is part of a
composite foreign key. To assert only simple foreign keys, use the
[`columnIsForeignKey`](ColumnIsForeignKey.md) assertion.

### Parameters

None.

#### Examples

```yaml
-
    assertion: columnIsPartOfForeignKey
```
