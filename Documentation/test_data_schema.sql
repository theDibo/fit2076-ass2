/* Test Data Creation File */

/* Seller Data */
INSERT INTO Seller VALUES (
seller_seq.nextval, 'Jack', 'Morrison', '1 Soldier Lane', 'Clayton', 'VIC', '0123456789', null, 'jmorrison@omail.com', 'Y'
);

INSERT INTO Seller VALUES (
seller_seq.nextval, 'Hanzo', 'Shimada', '4/23 Center Road', 'Ormond', 'VIC', null, '0234567891', 'hshimada@omail.com', 'Y'
);

INSERT INTO Seller VALUES (
seller_seq.nextval, 'Lucio', 'Santos', '63 Jammin Street', 'Bentleigh', 'VIC', null, null, 'lsantos@omail.com', 'N'
);

INSERT INTO Seller VALUES (
seller_seq.nextval, 'Jesse', 'McCree', '39 Cowboy Parade', 'Braeside', 'VIC', null, '0434123876', 'jmcree@omail.com', 'Y'
);

INSERT INTO Seller VALUES (
seller_seq.nextval, 'Gabriel', 'Reyes', '420 Edgy Road', 'Brighton', 'VIC', '0398765432', null, 'greyes@omail.com', 'N'
);

INSERT INTO Seller VALUES (
seller_seq.nextval, 'Billy', 'Bob', '9 Country Avenue', 'Frankston', 'VIC', '0394587878', null, 'bbobboy@mail.com', 'Y'
);

INSERT INTO Seller VALUES (
seller_seq.nextval, 'Jimbles', 'Jambles', '73 Road Street', 'Brighton East', 'VIC', '0398765432', null, 'jjjam@hotmail.com', 'Y'
);

INSERT INTO Seller VALUES (
seller_seq.nextval, 'Gabby', 'Redd', '5 Secret Parade', 'Toorak', 'VIC', null, '0487112665', 'gredd@mail.com', 'N'
);

INSERT INTO Seller VALUES (
seller_seq.nextval, 'Darcie', 'Swan', '23 Fancy Way', 'Brunswick', 'VIC', '0398987878', null, 'dstft@gmail.com', 'Y'
);

INSERT INTO Seller VALUES (
seller_seq.nextval, 'Mitch', 'Whales', '23 Fancy Way', 'Brunswick', 'VIC', '0398987878', null, 'dstft2@gmail.com', 'Y'
);

/* Buyer Data */
INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Lena', 'Oxton', '6 Speedy Lane', 'Ormond', 'VIC', null, '0436454656', 'loxton@omail.com', 'Y'
);

INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Jamison', 'Fawkes', '51 Rough Street', 'Frankston', 'VIC', '0387569887', null, 'jfawkes@omail.com', 'N'
);

INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Mei-Ling', 'Zhou', '3/64 Frosty Drive', 'North Melbourne', 'VIC', null, '0498561324', 'mzhou@omail.com', 'Y'
);

INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Amelie', 'Lacroix', '2 Scope Street', 'Bentleigh', 'VIC', null, '0498565678', 'alacroix@omail.com', 'Y'
);

INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Mako', 'Rutledge', '51 Rough Street', 'Frankston', 'VIC', '0387569887', null, 'mrutledge@omail.com', 'Y'
);

INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Markus', 'Makers', '11 Road Street', 'Frankston', 'VIC', '0398565151', null, 'makeme@gmail.com', 'Y'
);

INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Fisherman', 'Phil', '13 Ocean Way', 'Black Rock', 'VIC', null, '0436785454', 'atchme@mail.com', 'Y'
);

INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Sheldon', 'Scully', '64 Street Parade', 'Brunswick', 'VIC', '0398765454', null, 'scullboi@omail.com', 'Y'
);

INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Barry', 'Bartledge', '123 High Road', 'Bacchus March', 'VIC', '0398321654', null, 'bazzaaa@pmail.com', 'Y'
);

INSERT INTO Buyer VALUES (
buyer_seq.nextval, 'Thomas', 'Tankeng', '51 Sodor Avenue', 'Clayton', 'VIC', null, '0487565323', 'peeppeep@smail.com', 'Y'
);

/* PropertyType Data */
INSERT INTO PropertyType VALUES (
propertytype_seq.nextval, 'House', 'A house in a residential area.'
);

INSERT INTO PropertyType VALUES (
propertytype_seq.nextval, 'Apartment', 'An apartment in a residential area.'
);

INSERT INTO PropertyType VALUES (
propertytype_seq.nextval, 'Shop', 'A shopfront in a commercial area.'
);

INSERT INTO PropertyType VALUES (
propertytype_seq.nextval, 'Factory', 'A factory in an industrial area.'
);

INSERT INTO PropertyType VALUES (
propertytype_seq.nextval, 'Warehouse', 'A warehouse in an industrial area.'
);

/* Feature Data */
INSERT INTO Feature VALUES (
feature_seq.nextval, 'Tennis Court', 'A large court for playing tennis'
);

INSERT INTO Feature VALUES (
feature_seq.nextval, 'Swimming Pool - Above Ground', 'An above-ground pool for swimming in'
);

INSERT INTO Feature VALUES (
feature_seq.nextval, 'Swimming Pool - Below Ground', 'A below-ground pool for swimming in'
);

INSERT INTO Feature VALUES (
feature_seq.nextval, 'Wine Cellar', 'A specialised room for storing wine'
);

INSERT INTO Feature VALUES (
feature_seq.nextval, 'Helipad', 'A landing pad for helicopters'
);

INSERT INTO Feature VALUES (
feature_seq.nextval, 'Showroom', 'An open room for displaying items to customers'
);

COMMIT;