-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Customer (name, password, address, phone, email) VALUES('Pekka', 123456, 'Helsinki 00600', 12354, 'pekka@gmail.com');
INSERT INTO Customer (name, password, address, phone, email) VALUES('Pena', 123456, 'Tammela 31300', 00002, 'Pena@hotmail.com');
INSERT INTO Section  (name) VALUES('Musiikki');
INSERT INTO Product  (sectionId,name, startPrice, description)    VALUES(1,'Sähkökitara',500,'Hyvä kitara');
INSERT INTO Auction  (customerId, productId) VALUES(1,1);
INSERT INTO Bid      (customerId,auctionId,price) VALUES(2,1,600);