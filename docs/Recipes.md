## booleans are `NOT NULL`, have a default, and are named `is_*` or `has_*`

    -
        label: booleans are NOT NULL and named is_* or has_*
        scanner: column
        include:
            - { assertion: columnHasType, type: boolean }
        assertions:
            - { assertion: columnHasDefault }
            - { assertion: columnIsNullable, invert: true }
            - { assertion: columnNameMatchesRegex, pattern: /^(is|has)_/i }

## timestamps are named `*_at`

    -
        label: timestamps are named *_at
        scanner: column
        include:
            - { assertion: columnHasType, type: datetime }
        assertions:
            - { assertion: columnNameMatchesRegex, pattern: /_at$/i }

## columns named `id` are primary keys

    -
        label: columns named id are primary keys
        scanner: column
        include:
            - { assertion: columnNameMatchesRegex, pattern: /^id$/i }
        assertions:
            - { assertion: columnIsPrimaryKey }
            - { assertion: columnHasType, type: integer }
            - { assertion: columnHasDefault, value: 0 }
            - { assertion: columnIsNullable, invert: true }

## primary keys are named `id`

    -
        label: primary keys are named id
        scanner: column
        include:
            - { assertion: columnIsPrimaryKey }
        assertions:
            - { assertion: columnNameMatchesRegex, pattern: /^id$/i }
            - { assertion: columnHasType, type: integer }
            - { assertion: columnHasDefault }
            - { assertion: columnIsNullable, invert: true }

## Foreign key columns are named consistently.

We can ensure that foreign keys are named `*_id`

columns named `*_id` are foreign keys

    -
        label: columns named *_id are foreign keys
        scanner: column
        include:
            - { assertion: columnNameMatchesRegex, pattern: /_id$/i }
        assertions:
            - { assertion: columnIsForeignKey }
            - { assertion: columnHasType, type: integer }
            - { assertion: columnIsNullable, invert: true }

## Foreign key column name matches the linked table.

We can ensure consistency between foreign key columns and the tables that
they're tied to. For example, all columns that are foreign keys to `foo.id`
should be named `foo_id`:

    -
        label: fkeys to foo.id are named foo_id
        scanner: column
        include:
            - { assertion: columnIsForeignKey, toTable: foo, toColumn: id }
        assertions:
            - { assertion: columnNameMatchesRegex, pattern: /^foo_id$/i }

And all columns named `foo_id` should be foreign keys to `foo.id`:

    -
        label: columns named foo_id are fkeys to foo.id
        scanner: column
        include:
            - { assertion: columnNameMatchesRegex, pattern: /^customer_id$/i }
        assertions:
            - { assertion: columnIsForeignKey, toTable: customer, toColumn: id }
