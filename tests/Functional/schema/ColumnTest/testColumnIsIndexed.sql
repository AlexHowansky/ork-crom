CREATE TABLE pumpkin (
    spaghetti INT,
    zucchini INT,
    yellow INT,
    gourd INT
)

CREATE INDEX idx_pumpkin ON pumpkin (spaghetti, zucchini)

CREATE INDEX idx_gourd ON pumpkin (gourd)
