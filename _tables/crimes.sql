CREATE TABLE crimes (
  Id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  CrimeName varchar(100) NOT NULL,
  DateAdded datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
