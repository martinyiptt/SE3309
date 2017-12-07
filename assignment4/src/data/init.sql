CREATE DATABASE test;

use test;




CREATE TABLE customer
(
	customerid		INT NOT NULL AUTO_INCREMENT,
    fullname		VARCHAR(30) NOT NULL,
    dateofbirth		DATE,
    street			VARCHAR(20),
    city			VARCHAR(20),
    province		VARCHAR(2),
    postal			VARCHAR(6),
    phone			VARCHAR(10),
    email			VARCHAR(35) NOT NULL,
    UNIQUE (email,customerid),
    PRIMARY KEY (customerid)

);
CREATE TABLE accountdescription
(
	adid 			INT NOT NULL AUTO_INCREMENT,
	accounttype 	VARCHAR(10)
		DEFAULT 'CHECKING'
		CHECK (VALUE IN ('CREDIT','SAVINGS','CHECKING','STUDENT','YOUTH')),
	typedescription varchar(100),
    createddate 	DATE NOT NULL,
    PRIMARY KEY (adid)
);

CREATE TABLE branch
(
	branchname		VARCHAR(30) NOT NULL,
    branchnumber	INT(4) NOT NULL AUTO_INCREMENT,
	street			VARCHAR(20),
    city			VARCHAR(20),
    province		VARCHAR(2),
    postal			VARCHAR(6),
	UNIQUE (branchname),
    PRIMARY KEY (branchnumber)
);

CREATE TABLE customeraccount
(
    customerid      INT,
	accountnumber 	INT(15) NOT NULL AUTO_INCREMENT,
    balance 		DECIMAL(11,2) NOT NULL DEFAULT 0,
    adid 			INT,
    branchnumber	INT(4),
    PRIMARY KEY (accountnumber),
    FOREIGN KEY (adid)
		REFERENCES accountdescription(adid)
		ON UPDATE CASCADE ON DELETE NO ACTION,
	FOREIGN KEY (customerid)
		REFERENCES customer(customerid)
        ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY (branchnumber)
		REFERENCES branch(branchnumber)
        ON UPDATE CASCADE ON DELETE NO ACTION
);

CREATE TABLE transactiontype
(
	transactiontypeid INT NOT NULL AUTO_INCREMENT,
    transactiontype VARCHAR(15)
		CHECK (VALUE IN ('GOODS/MATERIALS','SERVICES','SALES','WAGES','TAX')),
    method varchar(15) NOT NULL
		CHECK (VALUE IN ('CHECK','ATM','ONLINE','TRANSFER','POS')),
    PRIMARY KEY (transactiontypeid)
);

CREATE TABLE transactionhistory
(
	transactionid INT NOT NULL AUTO_INCREMENT,
    transactiondate DATE NOT NULL,
    netchange DECIMAL(9,2) NOT NULL,
    accountnumber	INT(15),
    transactiontypeid INT,
    PRIMARY KEY (transactionid),
    FOREIGN KEY (accountnumber)
		REFERENCES customeraccount(accountnumber)
        ON UPDATE CASCADE ON DELETE SET NULL,
	FOREIGN KEY (transactiontypeid)
		REFERENCES transactiontype(transactiontypeid)
        ON DELETE NO ACTION ON UPDATE CASCADE
);

