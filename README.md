# Ork CROM

![Coding Standards](https://github.com/AlexHowansky/ork-crom/actions/workflows/phpcs.yml/badge.svg)
![Static Analysis](https://github.com/AlexHowansky/ork-crom/actions/workflows/phpstan.yml/badge.svg)
![Unit Tests](https://github.com/AlexHowansky/ork-crom/actions/workflows/test-unit.yml/badge.svg)

CROM is a tool to ensure that the schema of a relational database meets a given
set of rules. For example, it can verify that columns have camelcase names or
that tables have integer primary keys named `id`.

CROM can be used with any database supported by [Doctrine DBAL](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/introduction.html).

It is configuration file driven, designed to run autonomously, and is suitable
for use in build pipelines.

## Scanners

CROM can scan the following database assets:

* columns
* indexes
* namespaces (aka schemas or tablespaces)
* tables


## Assertions

Each asset scanned is subject to one or more assertions. Assertions are like
those provided by unit testing suites, they are very small tests that evaluate
to true or false.
