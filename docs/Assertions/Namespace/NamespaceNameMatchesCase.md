# `namespaceNameMatchesCase`

Asserts that a table name matches a given casing strategy.

## Description

This assertion will pass if the name of the namespace complies with the given
casing strategy. The following strategies are available:

|Strategy|Example|
|:-|:-|
|`camel`|`fooBar`|
|`pascal`|`FooBar`|
|`snake`|`foo_bar`|
|`ada`|`Foo_Bar`|
|`macro`|`FOO_BAR`|
|`kebab`|`foo-bar`|
|`train`|`Foo-Bar`|
|`cobol`|`FOO-BAR`|
|`lower`|`foo bar`|
|`upper`|`FOO BAR`|
|`title`|`Foo Bar`|
|`sentence`|`Foo bar`|
|`dot`|`foo.bar`|

Note that not all databases support names using all strategies and that some
databases (e.g., Postgres) have case-insensitive names.

### Parameters

|Name|Required|Description|
|:-|:-|:-|
|`strategy`|yes|The name of the casing strategy to use.|

#### Examples

```yaml
-
    assertion: namespaceNameMatchesCase
    strategy: snake
```
