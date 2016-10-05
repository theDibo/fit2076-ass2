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