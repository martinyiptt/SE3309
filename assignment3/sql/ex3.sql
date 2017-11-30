USE clientbanking;

INSERT INTO customer
		VALUES (1,'James Cameron', '2007-9-13', 'Acelof','London','ON','L5G4T6','9051111111','asd@asd.ca');
SELECT * FROM customer;
#all rows

INSERT INTO customer(fullname,postal,email)
		VALUES ('John James','A1A1A1','databases@oracle.org');
SELECT * FROM customer;
#some specified rows

INSERT INTO customeraccount(accountnumber,customerid) 
	VALUES (1,
			(SELECT customerid 
			FROM customer 
			WHERE customerid=2));
SELECT * FROM customeraccount;
#INSERT INTO WITH SELECTION FROM OTHER TABLE




