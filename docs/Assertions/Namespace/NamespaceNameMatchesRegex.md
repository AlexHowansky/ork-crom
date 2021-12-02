# `namespaceNameMatchesRegex`

Asserts that a namespace name matches a given regex pattern.

## Description

This assertion will pass if the name of the namespace matches the given regex
pattern.

Note that some databases (e.g., Postgres) have case-insensitive names.

### Parameters

|Name|Required|Description|
|:-|:-|:-|
|`pattern`|yes|The regex pattern to use.|

#### Examples

```yaml
-
    assertion: namespaceNameMatchesRegex
    pattern: /^dev_/
```
