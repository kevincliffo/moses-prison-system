CREATE TABLE prisons (
  Id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Name varchar(100) NOT NULL,
  County varchar(50) NOT NULL,
  DateAdded datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
