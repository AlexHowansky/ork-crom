# `indexNameMatchesRegex`

Asserts that an index name matches a given regex pattern.

## Description

This assertion will pass if the name of the index matches the given regex
pattern.

Note that some databases (e.g., Postgres) have case-insensitive names.

### Parameters

|Name|Required|Description|
|:-|:-|:-|
|`pattern`|yes|The regex pattern to use.|

#### Examples

```yaml
-
    assertion: indexNameMatchesRegex
    pattern: /^dev_/
```
