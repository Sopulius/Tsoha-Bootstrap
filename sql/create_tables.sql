-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Section(
    id SERIAL PRIMARY KEY,
    name varchar(50) NOT NULL
);

CREATE TABLE Product(
    id SERIAL PRIMARY KEY,
    sectionId INTEGER REFERENCES Section(id),
    startPrice NUMERIC NOT NULL,
    description varchar(300) NOT NULL
);

CREATE TABLE Customer(
    id SERIAL PRIMARY KEY,
    name varchar(20) NOT NULL,
    password varchar(30) NOT NULL,
    phone INTEGER NOT NULL,
    address varchar(120) NOT NULL,
    email varchar(100) NOT NULL
);

CREATE TABLE Auction(
    id SERIAL PRIMARY KEY,
    customerId INTEGER REFERENCES Customer(id),
    productId INTEGER REFERENCES Product(id),
    startDate DATE,
    endDate DATE
);

CREATE TABLE Invoice(
    id SERIAL PRIMARY KEY,
    auctionId INTEGER REFERENCES Auction(id)
);

Create TABLE Bid(
    customerId INTEGER REFERENCES Customer(id),
    auctionId INTEGER REFERENCES Auction(id),
    price NUMERIC NOT NULL
);