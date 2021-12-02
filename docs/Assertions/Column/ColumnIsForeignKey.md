# `columnIsForeignKey`

Asserts that a column is a foreign key.

## Description

This assertion will pass if the column is a simple foreign key. The assertion
will fail if the column is part of a composite foreign key. For that case, use
the [`columnIsPartOfForeignKey`](ColumnIsPartOfForeignKey.md) assertion.

### Parameters

None.

#### Examples

```yaml
-
    assertion: columnIsForeignKey
```
