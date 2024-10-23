CREATE TABLE Users(
	UserID INT AUTO_INCREMENT PRIMARY KEY,	
    Username VARCHAR(50),
	FirstName VARCHAR(50),
	LastName VARCHAR(50),
	DateOfBirth DATE,
	Gender VARCHAR(50),
	Course VARCHAR(50),
	DreamProfession VARCHAR(50),
	DreamRole VARCHAR(50),
	DateAdded DATE
);