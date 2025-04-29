-- Users

-- Log In
SELECT * FROM users where username = 'values';

-- Sign Up
INSERT INTO `pedobu`.`users` (`username`, `password`, `fullName`, `phoneNumber`, `balance`, `securityPin`) VALUES ('username', 'password', 'Full Name', '1234567890', '0', '000000');


-- view user data
SELECT * FROM users;