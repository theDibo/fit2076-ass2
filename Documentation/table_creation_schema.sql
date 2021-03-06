/* Delete all existing tables and sequences */
DROP SEQUENCE buyer_seq;
DROP SEQUENCE feature_seq;
DROP SEQUENCE listing_seq;
DROP SEQUENCE picture_seq;
DROP SEQUENCE property_seq;
DROP SEQUENCE propertytype_seq;
DROP SEQUENCE seller_seq;

DROP TABLE Listing;
DROP TABLE Picture;
DROP TABLE PropertyFeature;
DROP TABLE Feature;
DROP TABLE Property;
DROP TABLE PropertyType;
DROP TABLE Buyer;
DROP TABLE Seller;

/* Seller Table */
CREATE TABLE Seller (
seller_id INTEGER NOT NULL,
seller_fname VARCHAR(20) NOT NULL,
seller_lname VARCHAR(20) NOT NULL,
seller_address VARCHAR(50) NOT NULL,
seller_suburb VARCHAR(30) NOT NULL,
seller_state CHAR(3) NOT NULL,
seller_phone CHAR(10),
seller_mobile CHAR(10),
seller_email VARCHAR(60) NOT NULL,
seller_mailing CHAR(1) NOT NULL,
CONSTRAINT PK_Seller PRIMARY KEY (seller_id),
CONSTRAINT BOOL_Seller CHECK (seller_mailing in ('Y', 'N'))
);

CREATE SEQUENCE seller_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOCACHE;

/* Buyer Table */
CREATE TABLE Buyer (
buyer_id INTEGER NOT NULL,
buyer_fname VARCHAR(20) NOT NULL,
buyer_lname VARCHAR(20) NOT NULL,
buyer_address VARCHAR(50) NOT NULL,
buyer_suburb VARCHAR(30) NOT NULL,
buyer_state CHAR(3) NOT NULL,
buyer_phone CHAR(10),
buyer_mobile CHAR(10),
buyer_email VARCHAR(60) NOT NULL,
buyer_mailing CHAR(1) NOT NULL,
CONSTRAINT PK_Buyer PRIMARY KEY (buyer_id),
CONSTRAINT BOOL_Buyer CHECK (buyer_mailing in ('Y', 'N'))
);

CREATE SEQUENCE buyer_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOCACHE;

/* Property Type Table */
CREATE TABLE PropertyType (
type_id INTEGER NOT NULL,
type_name VARCHAR(30) NOT NULL,
type_desc VARCHAR(150),
CONSTRAINT PK_PropertyType PRIMARY KEY (type_id)
);

CREATE SEQUENCE propertytype_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOCACHE;

/* Property Table */
CREATE TABLE Property (
property_id INTEGER NOT NULL,
property_address VARCHAR(50) NOT NULL,
property_suburb VARCHAR(30) NOT NULL,
type_id INTEGER NOT NULL,
property_bedrooms INTEGER NOT NULL,
property_bathrooms INTEGER NOT NULL,
property_carparks INTEGER NOT NULL,
CONSTRAINT PK_Property PRIMARY KEY (property_id),
CONSTRAINT FK_Property_type FOREIGN KEY (type_id) 
REFERENCES PropertyType(type_id)
);

CREATE SEQUENCE property_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOCACHE;

/* Feature Table */
CREATE TABLE Feature (
feature_id INTEGER NOT NULL,
feature_name VARCHAR(30) NOT NULL,
feature_desc VARCHAR(250),
CONSTRAINT PK_Feature PRIMARY KEY (feature_id)
);

CREATE SEQUENCE feature_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOCACHE;

/* Property-Feature Table */
CREATE TABLE PropertyFeature (
property_id INTEGER NOT NULL,
feature_id INTEGER NOT NULL,
CONSTRAINT PK_PropertyFeature PRIMARY KEY (property_id, feature_id),
CONSTRAINT FK_PropertyFeature_property FOREIGN KEY (property_id) 
REFERENCES Property(property_id),
CONSTRAINT FK_PropertyFeature_feature FOREIGN KEY (feature_id) 
REFERENCES Feature(feature_id)
);

/* Picture Table */
CREATE TABLE Picture (
pic_id INTEGER NOT NULL,
pic_name VARCHAR(100) NOT NULL,
property_id INTEGER NOT NULL,
CONSTRAINT PK_Picture PRIMARY KEY (pic_id),
CONSTRAINT FK_Picture_property FOREIGN KEY (property_id) 
REFERENCES Property(property_id)
);

CREATE SEQUENCE picture_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOCACHE;

/* Listing Table */
CREATE TABLE Listing (
listing_id INTEGER NOT NULL,
seller_id INTEGER NOT NULL,
property_id INTEGER NOT NULL,
listing_desc VARCHAR(1000),
listing_date DATE NOT NULL,
listing_price INTEGER NOT NULL,
sale_date DATE,
sale_price INTEGER,
CONSTRAINT PK_Listing PRIMARY KEY (listing_id),
CONSTRAINT FK_Listing_seller FOREIGN KEY (seller_id) 
REFERENCES Seller(seller_id),
CONSTRAINT FK_Listing_property FOREIGN KEY (property_id) 
REFERENCES Property(property_id)
);

CREATE SEQUENCE listing_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1
NOCACHE;