CREATE TABLE customers (
    customer_id INT NOT NULL,
    score INT DEFAULT 0 NOT NULL,
    PRIMARY KEY (customer_id)
)

CREATE TABLE states (
    state_id INT NOT NULL,
    state_name VARCHAR(64) NOT NULL,
    PRIMARY KEY (state_id, state_name)
)

CREATE TABLE invoices (
    invoice_id INT NOT NULL,
    invoice_customer_id INT NOT NULL,
    invoice_state_id INT NOT NULL,
    invoice_state_name VARCHAR(64) NOT NULL,
    total NUMERIC(8,2) DEFAULT 0 NOT NULL,
    PRIMARY KEY (invoice_id),
    FOREIGN KEY (invoice_state_id, invoice_state_name) REFERENCES states (state_id, state_name),
    FOREIGN KEY (invoice_customer_id) REFERENCES customers (customer_id)
)
