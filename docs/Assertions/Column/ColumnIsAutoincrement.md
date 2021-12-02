# `columnIsAutoincrement`

Asserts that a column is automatically incremented.

## Description

This assertion will pass if the column is configured to autoincrement via the
database's native mechanism.

### Parameters

None.

#### Examples

```yaml
-
    assertion: columnIsAutoincrement
```
