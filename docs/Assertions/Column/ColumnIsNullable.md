# `columnIsNullable`

Asserts that a column can contain a null value.

## Description

This assertion will pass if the column can contain a null value. This is
commonly combined with the global `invert` flag to assert that the column has
been defined `NOT NULL`.

### Parameters

None.

#### Examples

Assert that the column can contain a null:

```yaml
-
    assertion: columnIsNullable
```

Assert that the column can _not_ contain a null:

```yaml
-
    assertion: columnIsNullable
    invert: true
```
