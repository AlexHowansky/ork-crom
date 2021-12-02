# DebugHandler

The included `DebugHandler` can be used to dump details about database assets.
This can aid in determining what indexes and keys are defined on tables, or
what data types Doctrine thinks your columns are. Include a logger section as
follows:

```yaml
logger:
    handlers:
        -
            handler: \Ork\Crom\DebugHandler
```

And then one or more scanners to iterate over the desired assets.

```yaml
scanners:
    -
        scanner: table
        assertions:
            - { assertion: tableNameMatchesRegex, pattern: /./ }
    -
        scanner: column
        assertions:
            - { assertion: columnNameMatchesRegex, pattern: /./ }
```

Each asset scanned will be dumped to the console:

```text
table
  namespace:
  table: customers
  primary key columns:
    id [integer]
  foreign keys:
  indexes:
    primary: [UNIQUE] id
  comment:

column
  namespace:
  table: customers
  column: id
  type: integer
  default:
  nullable: no
  autoincrement: no
  signed: yes
  fixed: no
  length:
  precision: 10
  scale: 0
  comment:

column
  namespace:
  table: customers
  column: score
  type: integer
  default: 0
  nullable: no
  autoincrement: no
  signed: yes
  fixed: no
  length:
  precision: 10
  scale: 0
  comment:
```
