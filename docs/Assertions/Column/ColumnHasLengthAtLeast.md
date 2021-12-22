# `columnHasLengthAtLeast`

Asserts that a column has at least the given length.

## Description

This assertion will pass if the column's length matches or exceeds the given value.

### Parameters

|Name|Required|Description|
|:-|:-|:-|
|`length`|yes|The length to assert that the column has.|

#### Examples

```yaml
-
    assertion: columnHasLengthAtLeast
    length: 8
```
