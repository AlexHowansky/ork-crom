# Configuration

CROM is configured via YAML or JSON files.

## `database`

Exactly one `database` section must be provided. To scan multiple databases,
create multiple configuration files. The available parameters are documented in
the [Doctrine DBAL reference][dbal].

```yaml
database:
    driver: pdo_pgsql
    dbname: my_database
    host: 1.2.3.4
    port: 5432
    user: my_username
    password: my_password
```

## `logger`

Runtime activity will be logged to any handlers specified in the optional
`logger` section. An arbitrary number of handlers that implement `\Monolog\Handler\HandlerInterface` may be specified. The `args` parameter may
be used to pass parameters to the handler's constructor.

```yaml
logger:
    name: cromlog
    handlers:
        -
            handler: \Monolog\Handler\StreamHandler
            args: ['/path/to/crom.log', debug]
        -
            handler: \Monolog\Handler\LogglyHandler
            args: ['my_loggly_token', notice]
```

CROM logs assertion passes at `notice` and failures at `error`. Other progress
details are logged at `debug`.

## `progress`

Progress information may be displayed to the console via the use of the optional
`progress` parameter.

```yaml
progress: verbose
```

The following `progress` meters are available:

|Name|Description|
|:-|:-|
|`dots`|Displays one dot per assertion.|
|`fail`|Displays detailed information for assertion failures.|
|`silent`|Displays no output.|
|`summary`|Displays a summarization of assets and assertions when complete.|
|`verbose`|Displays detailed information for all assertions.|

If no progress meter is specified, the `silent` meter will be used.

## `scanners`

Scanners determine what part(s) of your database will be tested. At least one
must be specified. Each scanner section must have one `scanner` that specifies
the asset being scanned, and one or more assertions that will be applied to
each scanned asset. Assertions work on specific types of assets. For example,
the `tableHasPrimaryKey` assertion may be specified only for the `table`
scanner. If an optional `label` is specified, it will be used for logs and
progress meters.

```yaml
scanners:
    -
        label: ensure table names are camel case
        scanner: table
        assertions:
            - { assertion: tableNameMatchesCase, strategy: camel }
```

An arbitrary number of assertions may be specified for each scanner.

```yaml
scanners:
    -
        scanner: table
        assertions:
            - { assertion: tableHasPrimaryKey }
            - { assertion: tableNameMatchesRegex, pattern: /^TEST_/ }
```

These will be applied via logical `AND`. I.e., all assertions must pass or an
error will be issued.

An arbitrary number of scanners may be specified, and the same assets may be
scanned multiple times.

```yaml
scanners:
    -
        scanner: table
        assertions:
            - { assertion: tableHasPrimaryKey }
    -
        scanner: table
        assertions:
            - { assertion: tableNameMatchesRegex, pattern: /^TEST_/ }
    -
        scanner: column
        assertions:
            - { assertion: columnNameMatchesCase, strategy: snake }
```

Scanners may be restricted to a subset of assets via the `include` parameter,
which takes one or more assertions as arguments. If a scanned asset passes all
the assertions specified in the `include` parameter, then it will be tested
against the assertions specified in the `assertions` parameter. This is useful
to create conditional rules.

```yaml
scanners:
    -
        label: ensure that all pkeys are named id
        scanner: column
        include:
            - { assertion: columnIsPrimaryKey }
        assertions:
            - { assertion: columnNameMatchesRegex, pattern: /^id$/ }
```

Again, multiple assertions are applied via logical `AND`.

```yaml
scanners:
    -
        label: ensure that all booleans named is_* are NOT NULL
        scanner: column
        include:
            - { assertion: columnHasType, type: boolean }
            - { assertion: columnNameMatchesRegex, pattern: /^is_/ }
        assertions:
            - { assertion: columnHasDefault }
            - { assertion: columnIsNullable, invert: true }
```

[dbal]: https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html
