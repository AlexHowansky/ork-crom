# Ork CROM

[![Coding Standards][phpcs badge]][phpcs] [![Static Analysis][phpstan badge]][phpstan] [![Unit Tests][unit test badge]][unit test]

CROM is a tool that tests the schema of a relational database against a given
set of rules. It is useful to ensure consistency of design and adherence to
standards.

For example, it can verify that columns have camelcase names, that tables have
integer primary keys named `id`, or that boolean columns are defined as `NOT
NULL` and have a default value. CROM can be used with any database supported by
[Doctrine DBAL][dbal].

## Configuration

CROM is [configuration file](docs/Configuration.md) driven, designed to run autonomously, and is
suitable for use in build pipelines.

## Scanners

CROM can scan the following database assets:

* columns
* indexes
* namespaces (aka schemas or tablespaces)
* tables

## Assertions

Each asset scanned is subject to one or more assertions. Assertions are like
those provided by unit testing suites, they are very small tests that evaluate
to true or false. See the [list of assertions](docs/Assertions.md) for more detail.

[phpcs badge]: https://github.com/AlexHowansky/ork-crom/actions/workflows/phpcs.yml/badge.svg?branch=dev
[phpcs]: https://github.com/AlexHowansky/ork-crom/actions/workflows/phpcs.yml?query=branch%3Adev
[phpstan badge]: https://github.com/AlexHowansky/ork-crom/actions/workflows/phpstan.yml/badge.svg?branch=dev
[phpstan]: https://github.com/AlexHowansky/ork-crom/actions/workflows/phpstan.yml?query=branch%3Adev
[unit test badge]: https://github.com/AlexHowansky/ork-crom/actions/workflows/test-unit.yml/badge.svg?branch=dev
[unit test]: https://github.com/AlexHowansky/ork-crom/actions/workflows/test-unit.yml?query=branch%3Adev
[dbal]: https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/introduction.html
