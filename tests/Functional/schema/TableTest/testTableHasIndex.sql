CREATE TABLE Sheer_Orc (
    id INT
)

CREATE TABLE Elven_Twig (
    id INT PRIMARY KEY
)

CREATE TABLE Emerald_Ring (
    id1 INT,
    id2 INT
)

CREATE INDEX Emerald_Ring_Index ON Emerald_Ring (id1, id2)
