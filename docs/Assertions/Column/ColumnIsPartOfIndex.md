# `columnIsPartOfIndex`

Asserts that a column is part of an index.

## Description

This assertion will pass if the column is indexed by itself, or is any part of
a multi-column index. Consider this example:

```sql
CREATE TABLE foo (
    bar INT,
    baz INT
);

CREATE INDEX idx ON foo (bar, baz);
```

Note that, in this case, the assertion will pass for the `baz` column even
though it _does not_ provide a performance benefit when filtering solely on
that column:

```sql
SELECT * FROM foo WHERE baz = 1;
```

To determine if a column, by itself, benefits from an index, use the
[`columnIsIndexed`](ColumnIsIndexed.md) assertion.

### Parameters

None.

#### Examples

```yaml
-
    assertion: columnIsPartOfIndex
```
