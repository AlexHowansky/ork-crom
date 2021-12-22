
# Column Assertions

|Assertion Name|Description|
|:-|:-|
|[`columnHasDefault`](Assertions/Column/ColumnHasDefault.md)|Asserts that a column has a default value.|
|[`columnHasLength`](Assertions/Column/ColumnHasLength.md)|Asserts that a column has a given length.|
|[`columnHasLengthAtLeast`](Assertions/Column/ColumnHasLengthAtLeast.md)|Asserts that a column has at least a given length.|
|[`columnHasType`](Assertions/Column/ColumnHasType.md)|Asserts that a column has a given data type.|
|[`columnIsAutoincrement`](Assertions/Column/ColumnIsAutoincrement.md)|Asserts that a column is automatically incremented.|
|[`columnIsForeignKey`](Assertions/Column/ColumnIsForeignKey.md)|Asserts that a column is a foreign key.|
|[`columnIsNullable`](Assertions/Column/ColumnIsNullable.md)|Asserts that a column can contain a null value.|
|[`columnIsPartOfForeignKey`](Assertions/Column/ColumnIsPartOfForeignKey.md)|Asserts that a column is part of a foreign key.|
|[`columnIsPartOfPrimaryKey`](Assertions/Column/ColumnIsPartOfPrimaryKey.md)|Asserts that a column is part of a primary key.|
|[`columnIsPrimaryKey`](Assertions/Column/ColumnIsPrimaryKey.md)|Asserts that a column is a primary key.|
|[`columnNameMatchesCase`](Assertions/Column/ColumnNameMatchesCase.md)|Asserts that a column name matches a given casing strategy.|
|[`columnNameMatchesRegex`](Assertions/Column/ColumnNameMatchesRegex.md)|Asserts that a column name matches a given regex pattern.|

# Index Assertions

|Assertion Name|Description|
|:-|:-|
|[`indexNameMatchesCase`](Assertions/Index/IndexNameMatchesCase.md)|Asserts that an index name matches a given casing strategy.|
|[`indexNameMatchesRegex`](Assertions/Index/IndexNameMatchesRegex.md)|Asserts that an index name matches a given regex pattern.|

# Namespace Assertions

|Assertion Name|Description|
|:-|:-|
|[`namespaceNameMatchesCase`](Assertions/Namespace/NamespaceNameMatchesCase.md)|Asserts that a namespace name matches a given casing strategy.|
|[`namespaceNameMatchesRegex`](Assertions/Namespace/NamespaceNameMatchesRegex.md)|Asserts that a namespace name matches a given regex pattern.|

# Table Assertions

|Assertion Name|Description|
|:-|:-|
|[`tableHasPrimaryKey`](Assertions/Table/TableHasPrimaryKey.md)|Asserts that a table has a primary key.|
|[`tableNameMatchesCase`](Assertions/Table/TableNameMatchesCase.md)|Asserts that a table name matches a given casing strategy.|
|[`tableNameMatchesRegex`](Assertions/Table/TableNameMatchesRegex.md)|Asserts that a table name matches a given regex pattern.|

## Global Parameters

All assertions support the following optional global parameters.

### `invert`

Invert the truthiness of the assertion, so that it passes when false. For
example, to assert that a column is _not_ nullable:

```yaml
-
    assertion: columnIsNullable
    invert: true
```
