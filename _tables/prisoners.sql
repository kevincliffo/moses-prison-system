CREATE TABLE prisoners (
    Id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    FirstName varchar(100) NOT NULL,
    LastName varchar(100),
    Crime varchar(50) NOT NULL,
    Details varchar(255) NOT NULL,
    Prison varchar(100) NOT NULL,
    SentenceDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ReleaseDate datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
