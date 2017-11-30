#select */DISTINCT from tableName 

#distinct removes duplicates

#where - filter rows
#group by - forms groups of rows with same column value
#having - filters groups on condition
#select - choose columns
#order by - order of rows

#select all customeraccounts where balance < 1000
#select top customer accounts with most balance branch with branchname = "f mdfmhsk"
#sum transactions made in last year for branch
#branch with most customers - distinct
#join branch number with account number for card number

#more than 1 relation
#subqueries
#exists
#group by

#select all customeraccounts where balance < 1000
SELECT * FROM customeraccount
WHERE balance < 1000
ORDER BY balance;


#Most balance in branch with branchname = "f mdfmhsk"
SELECT MAX(balance)
FROM customeraccount
WHERE branchnumber = 
	(SELECT branchnumber
	 FROM branch
     WHERE branchname = "f mdfmhsk"
    );

#count number of account created after 2007
#grouped by the account type
SELECT COUNT(adid),accounttype
FROM accountdescription
WHERE createddate >= "2007-01-01"
GROUP BY accounttype;


#total for each method used for transactions
#ordered in descending order
#also using 2 relations in total
SELECT transactiontype.method, SUM(transactionhistory.netchange) totalNetChange
FROM transactiontype, transactionhistory
WHERE transactionhistory.netchange > 0
GROUP BY method
ORDER BY SUM(transactionhistory.netchange) DESC;

#customers of youth (between 20 and 25 years old)
#with a savings account
#*credit rating should go up because they think ahead
#2 nested subqueries
SELECT customer.fullname, customer.dateofbirth
FROM customer
WHERE customer.customerid IN (
	SELECT customeraccount.accountnumber
    FROM customeraccount
	WHERE customeraccount.adid IN
		( SELECT adid
		  FROM accountdescription
		  WHERE accounttype = "SAVINGS"
		)
	AND customer.dateofbirth BETWEEN "1992-01-01" AND "1997-01-01"
);

#using wildcards, find all phone numbers that start with the same area code 905
describe customer;
SELECT customer.fullname, customer.phone
FROM customer
WHERE customer.phone LIKE "905%"


