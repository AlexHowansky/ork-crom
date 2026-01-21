
CREATE TABLE B (
    id int
)

CREATE TABLE Z (
    id int
)

CREATE TABLE A (
    id int
)

CREATE TABLE C (
    id int
)

CREATE INDEX idx_b ON B (id);

CREATE INDEX idx_z ON Z (id);

CREATE INDEX idx_a ON A (id);

CREATE INDEX idx_c ON C (id);
