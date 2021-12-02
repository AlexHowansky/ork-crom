# `columnHasDefault`

Asserts that a column has a default value.

## Description

This assertion will pass if the column has a default value. If the optional
`value` parameter is specified, the assertion will pass only if it matches the
given value.

### Parameters

|Name|Required|Description|
|:-|:-|:-|
|`value`|no|The default value to assert that the column has.|

#### Examples

Assert that the column has any default value:

```yaml
-
    assertion: columnHasDefault
```

Assert that the column has a specific default value:

```yaml
-
    assertion: columnHasDefault
    value: 0
```
