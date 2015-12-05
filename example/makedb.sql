use kdn1566;

drop table IF EXISTS product;
drop table IF EXISTS users;
drop table IF EXISTS carts;

create table carts
(
    id varchar(255),
    items varchar(255),
    PRIMARY KEY (id)
);

# Make the table 
create table product
(
    id int NOT NULL auto_increment,
    name varchar(255),
    description varchar(255),
    price DECIMAL(10,2),
    quantity int,
    imgName varchar(255),
    salePrice DECIMAL(10,2),
    discounted BOOLEAN,
    sellable BOOLEAN,
    PRIMARY KEY (id)
);

# Make the table 
create table users
(
    id int NOT NULL auto_increment,
    userName varchar(255),
    pass CHAR(40),
    admin BOOLEAN,
    PRIMARY KEY (id)
);

INSERT INTO users (userName, pass, admin) VALUES ("admin", SHA1('password'), true);
INSERT INTO users (userName, pass, admin) VALUES ("user", SHA1('user'), false);

# Fill in the data
INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Rainforest", "Everything you want from A to Z", 1000.25, 37, "amazon.png", 500.10, false, true );

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Activity Area", "Arts and Crafts for the everyday man", 900.80, 11, "hobbylobby.png", 420.08, true, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Marcys", "The best department store", 55000.55, 41, "macys.jpg", 25000.10, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Good Buy", "Pretty good electronics", 4500.27, 22, "bestbuy.jpg", 2000.10, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Paperclips", "The office supply store", 25.00, 18, "staples.jpg", 15.15, true, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Pineapple", "Home of the piPhone", 890000.00, 34, "apple.png", 44000.00, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Forever 55", "Clothing for old people", 27000.00, 55, "forever21.png", 10000.00, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("ACNE", "Grocery store for teenagers", 8500.00, 16, "acme.png", 85.00, true, true );

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Brickbuster", "America's Favorite VHS Rental store", 188, 5.00, "blockbuster.jpg", 1.25, true, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Shirtz", "Food on the road", 3500.00, 294, "sheetz.png", 2000.00, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("FlorMart", "Prices as low as the floor", 20000.00, 781, "walmart.png", 15000.00, true, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Krueger", "Groceries to DIE for", 1234.00, 288, "kroger.png", 321.00, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Sanic", "Really fast food", 3324.00, 200, "Sanic.gif", 324.00, false, true); # you're welcome.

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("JT Min", "Really expensive clothes", 231.00, 140, "tjmaxx.png", 230.00, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Burger Prince", "Have it the right way!", 3345.00, 1738, "burgerking.jpg", 210.15, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Catco", "Bulk supplies for cats", 75000.00, 20000, "costco.jpg", 25000.75, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Hole", "Really trendy clothing", 2875.22, 1000, "gap.jpg", 1499.22, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("American Vulture", "Young fashion", 9822.11, 3000, "americaneagle.gif", 1499.22, false, true);

INSERT INTO product (name, description, price, quantity, imgName, salePrice, discounted, sellable) VALUES ("Radiohut", "From transistors to your next phone", 11.99, 4507, "radioshack.jpg", 5.75, false, true);

