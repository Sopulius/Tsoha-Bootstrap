-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Customer (name, password, address, phone, email, iban) VALUES('admin', 'qwerty','asdf',123141414, 'asdfs@gmail.com', 'FI2950251650074501');
INSERT INTO Customer (name, password, address, phone, email, iban) VALUES('Pekka', 123456, 'Helsinki 00600', 12354, 'pekka@gmail.com', 'FI2950251650074501');
INSERT INTO Customer (name, password, address, phone, email, iban) VALUES('Pena', 123456, 'Tammela 31300', 00002, 'Pena@hotmail.com', 'FI2950251650074501');

INSERT INTO Section  (name) VALUES('Musiikki');
INSERT INTO Section  (name) VALUES('Pelit');

INSERT INTO Product  (name, startPrice, description)    VALUES('Sähkökitara',500,'Hyvä kitara');
INSERT INTO Product  (name, startPrice, description)    VALUES('Basso',600,'Hyvä basso');
INSERT INTO Product  (name, startPrice, description)    VALUES('Rummut', 2000, 'Hyvät rummut');
INSERT INTO Auction  (sectionId,customerId, productId) VALUES(1,1,1);
INSERT INTO Auction  (sectionId,customerId, productId) VALUES(1,1,2);
INSERT INTO Auction  (sectionId,customerId, productId) VALUES(1,1,3);
INSERT INTO Bid      (customerId,auctionId,price) VALUES(2,1,600);
INSERT INTO Bid      (customerId, auctionId,price)VALUES(2,1,700);
INSERT INTO Invoice  (auctionId) VALUES(2);
