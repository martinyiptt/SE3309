#data modification
#inserting result of query
#update several tuples at once
#delete set of tuple that is > 1, <all




#the initial query from the last question
#promotion, top customer from everywhere
#gets a $1000 bonus to his balance
#because he is such a good client
#first query will give actual number
#update will then follow
#followed by requery
SELECT MAX(balance)
FROM customeraccount;
SET SQL_SAFE_UPDATES = 0;
UPDATE customeraccount
SET balance = balance + 1000
WHERE balance = 
	(
	SELECT MAX(balance)
	FROM (SELECT * from customeraccount) as something
	);
SELECT MAX(balance)
FROM customeraccount;







#update several tuples at once
#all customers born between 1997 and 2000 are given $1000
#as a birthday present for the year

#check inner select
SELECT customer.customerid
    FROM customer
    WHERE customer.dateofbirth BETWEEN "1997-01-01" AND "1998-01-01";
#Outer Balances
SELECT customeraccount.balance
FROM customeraccount
WHERE customerid IN
	(SELECT customerid
    FROM customer
     WHERE customer.dateofbirth BETWEEN "1997-01-01" AND "2000-01-01");
SET SQL_SAFE_UPDATES = 0;
#update
UPDATE customeraccount
SET balance = balance + 1000
WHERE customerid IN
	(SELECT customerid
    FROM customer
    WHERE customer.dateofbirth BETWEEN "1997-01-01" AND "2000-01-01");
#recheck outer balances for result
SELECT customeraccount.balance
FROM customeraccount
WHERE customerid IN
	(SELECT customerid
    FROM customer
    WHERE customer.dateofbirth BETWEEN "1997-01-01" AND "2000-01-01");

#delete set of tuple that is > 1, <all
#A User found that his account was hacked
#Need to delete all transactions for one of his accounts
#his account number is 145
#delete set of tuple that is > 1, <all

#show's the 3 transaction histories
SELECT * 
FROM transactionhistory
WHERE transactionhistory.accountnumber = '145';
#delete the 3 transactions from account 145
DELETE FROM transactionhistory
WHERE transactionhistory.accountnumber = '145';
#show that there are no more transactions
SELECT * 
FROM transactionhistory
WHERE transactionhistory.accountnumber = '145';



