CREATE TABLE slate (
    id INT,
    density INT
)

CREATE INDEX pkey ON slate (id)

CREATE INDEX IDX_SLATE_DENSITY ON slate (density)

CREATE INDEX idxSlateIdDensity ON slate (id, density)
