CREATE TABLE products (
  id SERIAL PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  price NUMERIC(10,2) NOT NULL
);

INSERT INTO products (name, price) VALUES
('Teclado', 25.50),
('Mouse', 12.00);
