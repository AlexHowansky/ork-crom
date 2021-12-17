# `columnHasLength`

Asserts that a column has a given length.

## Description

This assertion will pass if the column's length matches the given value.

### Parameters

|Name|Required|Description|
|:-|:-|:-|
|`length`|yes|The length to assert that the column has.|

#### Examples

```yaml
-
    assertion: columnHasLength
    length: 8
```
