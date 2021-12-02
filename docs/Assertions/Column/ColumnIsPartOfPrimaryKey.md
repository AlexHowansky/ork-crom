# `columnIsPartOfPrimaryKey`

Asserts that a column is part of a primary key.

## Description

This assertion will pass if the column is a simple primary key or is part of a
composite primary key. To assert only simple primary keys, use the
[`columnIsPrimaryKey`](ColumnIsPrimaryKey.md) assertion.

### Parameters

None.

#### Examples

```yaml
-
    assertion: columnIsPartOfPrimaryKey
```
