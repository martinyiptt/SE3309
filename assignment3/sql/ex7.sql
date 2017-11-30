#CREATE VIEW STATEMENTS
#QUERY WITH EACH VIEW
#SYSTEM RESPONSE

#what happens to view with modifications
#can they update?

#manager can see all accounts from his branch
CREATE VIEW ManagerBranch3
	AS SELECT *
    FROM customeraccount
    WHERE customeraccount.branchnumber = 3;
SELECT * FROM ManagerBranch3;

UPDATE customeraccount
SET branchnumber = 3
WHERE customeraccount.accountnumber = 3;

SELECT * FROM ManagerBranch3;


#can only see online transactions
CREATE VIEW onlinesupervisor
	AS SELECT *
    FROM transactionhistory
    WHERE transactionhistory.transactiontypeid IN
		(SELECT transactiontype.transactiontypeid
		 FROM transactiontype
         WHERE method = "ONLINE"
		);
SELECT * FROM onlinesupervisor;

CREATE VIEW accountview15
	AS SELECT *
    FROM transactionhistory
    where accountnumber IN
		(SELECT accountnumber
		 FROM transactionhistory
         WHERE  accountnumber = 15
		);
SELECT * FROM accountview15;
        
        
