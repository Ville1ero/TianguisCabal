	CREATE TABLE `Food` (
			`OrdenID` int(7) NOT NULL auto_increment,
			`Name` varchar(99) NOT NULL,
			`Comida` enum('Spaghetti','SoupAndSandwich','FishAndChips') NOT NULL,
			`Fecha` date NOT NULL default '2010-06-08',
			PRIMARY KEY  (`OrdenID`)
	)ENGINE=InnoDB DEFAULT CHARSET=utf8;
