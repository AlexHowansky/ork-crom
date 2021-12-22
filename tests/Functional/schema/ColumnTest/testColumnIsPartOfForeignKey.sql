CREATE TABLE owners (
    owner_id INT NOT NULL,
    age INT DEFAULT 0 NOT NULL,
    PRIMARY KEY (owner_id)
)

CREATE TABLE tires (
    tire_id INT NOT NULL,
    tire_name VARCHAR(64) NOT NULL,
    PRIMARY KEY (tire_id, tire_name)
)

CREATE TABLE cars (
    car_id INT NOT NULL,
    car_owner_id INT NOT NULL,
    car_tire_id INT NOT NULL,
    car_tire_name VARCHAR(64) NOT NULL,
    spin NUMERIC(8,2) DEFAULT 0 NOT NULL,
    PRIMARY KEY (car_id),
    FOREIGN KEY (car_tire_id, car_tire_name) REFERENCES tires (tire_id, tire_name),
    FOREIGN KEY (car_owner_id) REFERENCES owners (owner_id)
)
