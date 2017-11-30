#include <iostream>
#include <fstream>
#include <cstdlib> //rand
#include <ctime>
#include <string>
using namespace std;

string randomAlpha(string type, int length, bool fullLength) {

	char alpha[] = " abcdefghijklmnopqrstuvwxyz";
	char numeric[] = "0123456789";
	string acctypes[5] = { "CHECKING","SAVINGS","CREDIT","STUDENT","YOUTH"};
	string trantypes[5] = { "GOODS/MATERIALS","SERVICES","SALES","WAGES","TAX" };
	string method[5] = { "CHECK","ATM","TRANSFER","ONLINE","POS" };
	int len = (rand() % (length-1)) +1;
	string str(len, 0);
	string lstr(length, 0);

	if (type == "alpha"  && fullLength == false) {
		for (int i = 0; i < len; i++) {
			str[i] = alpha[rand() % 27];
		}
		return str;
	}
	else if (type == "alpha"  && fullLength == true) {
		for (int i = 0; i < length; i++) {
			lstr[i] = alpha[rand() % 27];
		}
		return lstr;
	}
	else if (type == "numeric" && fullLength == false) {
		for (int i = 0; i < len; i++) {
			str[i] = numeric[rand() % 10];
		}
		return str;
	}
	else if (type == "numeric" && fullLength == true) {
		for (int i = 0; i < length; i++) {
			lstr[i] = numeric[rand() % 10];
		}
		return lstr;
	}
	else if (type == "accounttype") {
		int randval = rand() % 5;
		return acctypes[randval];
	}
	else if (type == "transtype") {
		int randval = rand() % 5;
		return trantypes[randval];
	}
	else if (type == "method") {
		int randval = rand() % 5;
		return method[randval];
	}
	return str;
}

int main(int argc, char* argv[]) {

	srand(time(0)); //rand seed

	ofstream customerFab;
	customerFab.open("customerFab.csv");
	for (int i = 1; i <= 2000; i++) {
		int customerid = i;
		string fullName = randomAlpha("alpha",30, false);
		int year = rand() % 50 + 2017 - 50 + 1; // Last 50 years from 2017
		int month = rand() % 12 + 1;	//all months
		int day = rand() % 28 + 1;	//to ignore isues with FEB
		string dateofbirth = to_string(year) + '-' + to_string(month) + '-' + to_string(day);
		string street = randomAlpha("alpha", 20, false);
		string city = randomAlpha("alpha", 20, false);
		string province = randomAlpha("alpha", 2, true);
		string postal = randomAlpha("alpha", 6, true);
		string phone = randomAlpha("numeric", 10, true);
		string email = randomAlpha("alpha", 35, false);	
		string outs = to_string(customerid) + "," + fullName + "," + dateofbirth + "," + street + "," + city + "," + province + "," + postal + "," + phone + "," + email + "\n";
		customerFab << outs;
	}
	customerFab.close();

	ofstream branchFab;
	branchFab.open("branchFab.csv");
	for (int i = 1; i <= 5; i++) {
		string branchname = randomAlpha("alpha",30,false);
		int branchnumber = i;
		string street = randomAlpha("alpha", 20, false);
		string city = randomAlpha("alpha", 20, false);
		string province = randomAlpha("alpha", 2, true);
		string postal = randomAlpha("alpha", 6, true);
		string outs = branchname + "," + to_string(branchnumber) +"," + street + "," + city + "," + province + "," + postal + "\n";
		branchFab << outs;
	}
	branchFab.close();

	ofstream accountdescriptionFab;
	accountdescriptionFab.open("accountdescriptionFab.csv");
	for (int i = 1; i <= 500; i++) {
		int adid = i;
		string accounttype = randomAlpha("accounttype", 11, true);
		string typedescription = randomAlpha("alpha", 100, false);
		int year = rand() % 50 + 2017 - 50 + 1; // Last 50 years from 2017
		int month = rand() % 12 + 1;	//all months
		int day = rand() % 28 + 1;	//to ignore isues with FEB
		string createddate = to_string(year) + '-' + to_string(month) + '-' + to_string(day);
		string outs = to_string(adid)+ "," + accounttype + "," + typedescription + "," + createddate + "\n";
		
		accountdescriptionFab << outs;
	}
	accountdescriptionFab.close();
	
	ofstream customeraccountFab;
	customeraccountFab.open("customeraccountFab.csv");
	for (int i = 1; i <= 500; i++) {
		int accountnumber = i;
		int balancepos= rand() % 100000000;
		int decimal = rand() % 100;
		string balance = to_string(balancepos) + "." + to_string(decimal);
		int adid = accountnumber;
		int customerid = rand() % 100 + 1;
		int branchnumber = rand() % 5 + 1;
		string outs = to_string(accountnumber) + "," + balance + "," + to_string(adid) + "," + to_string(customerid) + "," + to_string(branchnumber) + "\n";
		customeraccountFab << outs;
	}
	customeraccountFab.close();
	
	ofstream transactiontypeFab;
	transactiontypeFab.open("transactiontypeFab.csv");
	for (int i = 1; i <= 2000; i++) {
		int transactiontypeid = i;
		string transactiontype = randomAlpha("transtype", 11, true);
		string method = randomAlpha("method", 11, true);
		string outs = to_string(transactiontypeid) + "," + transactiontype + "," + method + "\n";
		transactiontypeFab << outs;
	}
	transactiontypeFab.close();

	ofstream transactionhistoryFab;
	transactionhistoryFab.open("transactionhistoryFab.csv");
	for (int i = 1; i <= 2000; i++) {
		int transactionid = i;
		int transactiontypeid = transactionid;
		int accountnumber = rand() % 500 + 1;
		int year = rand() % 50 + 2017 - 50 + 1; // Last 50 years from 2017
		int month = rand() % 12 + 1;	//all months
		int day = rand() % 28 + 1;	//to ignore isues with FEB
		string transactiondate = to_string(year) + '-' + to_string(month) + '-' + to_string(day);

		int signi = rand() % 2;
		string signs;
		if (signi == 1 ) {
			signs = "-";
		}
		else {
			signs = "";
		}
		int netpos= rand() % 1000000;
		int decimal = rand() % 100;
		string netchange = signs + to_string(netpos) + "." + to_string(decimal);
		string outs = to_string(transactionid) + "," + transactiondate + "," + netchange + "," + to_string(accountnumber) + "," + to_string(transactiontypeid) + "\n";
		transactionhistoryFab << outs;
	}
	transactionhistoryFab.close();
	
	


	return 0;
}