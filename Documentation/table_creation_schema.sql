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
INCREMENT BY 1;

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
INCREMENT BY 1;

/* Agent Table */
CREATE TABLE Agent (
agent_id INTEGER NOT NULL,
agent_fname VARCHAR(20) NOT NULL,
agent_lname VARCHAR(20) NOT NULL,
agent_phone CHAR(10) NOT NULL,
agent_email VARCHAR(60) NOT NULL,
CONSTRAINT PK_Agent PRIMARY KEY (agent_id)
);

CREATE SEQUENCE agent_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1;

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
INCREMENT BY 1;

/* Property Table */
CREATE TABLE Property (
property_id INTEGER NOT NULL,
property_address VARCHAR(50) NOT NULL,
property_suburb VARCHAR(30) NOT NULL,
type_id INTEGER NOT NULL,
prop_bedrooms INTEGER NOT NULL,
prop_bathrooms INTEGER NOT NULL,
prop_carparks INTEGER NOT NULL,
prop_status CHAR(1) NOT NULL,
CONSTRAINT PK_Property PRIMARY KEY (property_id),
CONSTRAINT FK_Property_type FOREIGN KEY (type_id) 
REFERENCES PropertyType(type_id)
);

CREATE SEQUENCE property_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1;

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
INCREMENT BY 1;

/* Property-Feature Table */
CREATE TABLE PropertyFeature (
prop_id INTEGER NOT NULL,
feature_id INTEGER NOT NULL,
quantity INTEGER NOT NULL,
CONSTRAINT PK_PropertyFeature PRIMARY KEY (prop_id, feature_id),
CONSTRAINT FK_PropertyFeature_property FOREIGN KEY (prop_id) 
REFERENCES Property(property_id),
CONSTRAINT FK_PropertyFeature_feature FOREIGN KEY (feature_id) 
REFERENCES Feature(feature_id)
);

/* Picture Table */
CREATE TABLE Picture (
pic_id INTEGER NOT NULL,
pic_name VARCHAR(30) NOT NULL,
property_id INTEGER NOT NULL,
CONSTRAINT PK_Picture PRIMARY KEY (pic_id),
CONSTRAINT FK_Picture_property FOREIGN KEY (property_id) 
REFERENCES Property(property_id)
);

CREATE SEQUENCE picture_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1;

/* Listing Table */
CREATE TABLE Listing (
listing_id INTEGER NOT NULL,
seller_id INTEGER NOT NULL,
property_id INTEGER NOT NULL,
listing_desc VARCHAR(1000),
listing_date DATE NOT NULL,
listing_price INTEGER NOT NULL,
agent_id INTEGER NOT NULL,
CONSTRAINT PK_Listing PRIMARY KEY (listing_id),
CONSTRAINT FK_Listing_seller FOREIGN KEY (seller_id) 
REFERENCES Seller(seller_id),
CONSTRAINT FK_Listing_property FOREIGN KEY (property_id) 
REFERENCES Property(property_id),
CONSTRAINT FK_Listing_agent FOREIGN KEY (agent_id) 
REFERENCES Agent(agent_id)
);

CREATE SEQUENCE listing_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1;

/* Sale Table */
CREATE TABLE Sale (
sale_id INTEGER NOT NULL,
listing_id INTEGER NOT NULL,
sale_price INTEGER NOT NULL,
sale_date DATE NOT NULL,
CONSTRAINT PK_Sale PRIMARY KEY (sale_id),
CONSTRAINT FK_Sale_listing FOREIGN KEY (listing_id) 
REFERENCES Listing(listing_id)
);

CREATE SEQUENCE sale_seq
MINVALUE 1
START WITH 1
INCREMENT BY 1;