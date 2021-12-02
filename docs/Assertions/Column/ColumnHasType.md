# `columnHasType`

Asserts that a column has a given data type.

## Description

This assertion will pass if the column's data type matches the given type.

The available types and their mappings to specific database are enumerated on
the [Doctrine DBAL types page](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html).

Note that not all databases support all types, and there may be slight
differences between what your database calls a type and what Doctrine calls it.
You may use the [DebugHandler](../../DebugHandler.md) to dump your schema if
you are having problems determining the correct type to use.

### Parameters

|Name|Required|Description|
|:-|:-|:-|
|`type`|yes|The data type to assert that the column has.|

#### Examples

```yaml
-
    assertion: columnHasType
    type: integer
```

```yaml
-
    assertion: columnHasType
    type: datetime
```
