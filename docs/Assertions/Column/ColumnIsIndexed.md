# `columnIsIndexed`

Asserts that a column is indexed by itself, or starts an index.

## Description

This assertion will pass if the column is the first or only column in an index.
The assertion will fail if the column is part of a multi-column index but is
not the first column. For that case, use the
[`columnIsPartOfIndex`](ColumnIsPartOfIndex.md) assertion.

### Parameters

None.

#### Examples

```yaml
-
    assertion: columnIsIndexed
```
