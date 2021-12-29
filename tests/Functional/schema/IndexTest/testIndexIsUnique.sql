CREATE TABLE coke (
    pepsi INT,
    dew INT
)

CREATE INDEX fanta ON coke (pepsi)

CREATE UNIQUE INDEX polar ON coke (dew)
