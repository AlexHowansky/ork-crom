# `columnIsPrimaryKey`

Asserts that a column is a primary key.

## Description

This assertion will pass if the column is a simple primary key. The assertion
will fail if the column is part of a composite primary key. For that case, use
the [`columnIsPartOfPrimaryKey`](ColumnIsPartOfPrimaryKey.md) assertion.

### Parameters

None.

#### Examples

```yaml
-
    assertion: columnIsPrimaryKey
```
