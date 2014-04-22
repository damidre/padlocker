CREATE TABLE IF NOT EXISTS 'user' (
'id' INT(11) NOT NULL AUTO_INCREMENT,
'fname' varchar(255) NOT NULL,
'lname' varchar(255) NOT NULL,
'email' varchar(255) NOT NULL,
'uname' varchar(255) NOT NULL,
'pword' varchar(32) NOT NULL,
'activated' enum('0','1') NOT NULL,
PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;