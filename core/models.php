<?php 

// Function to insert a new user into the Users table
function insertIntoUserRecords($pdo, $firstName, $lastName, $dateOfBirth, $gender, $course, $dreamProfession, $dreamRole, $dateAdded) {
    $sql = "INSERT INTO Users (FirstName, LastName, DateOfBirth, Gender, Course, DreamProfession, DreamRole, DateAdded) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    $executeQuery = $stmt->execute([$firstName, $lastName, $dateOfBirth, $gender, $course, $dreamProfession, $dreamRole, $dateAdded]);

    return $executeQuery;
}

// Function to retrieve all user records from the Users table
function seeAllUserRecords($pdo) {
    $sql = "SELECT * FROM Users";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();
    if ($executeQuery) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

// Function to retrieve a user by UserID from the Users table
function getUserByID($pdo, $userID) {
    $sql = "SELECT * FROM Users WHERE UserID = ?";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$userID])) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return false;
}

// Function to update a user in the Users table
function updateAUser($pdo, $userID, $firstName, $lastName, $dateOfBirth, $gender, $course, $dreamProfession, $dreamRole) {
    $sql = "UPDATE Users 
            SET FirstName = ?, 
                LastName = ?, 
                DateOfBirth = ?, 
                Gender = ?, 
                Course = ?, 
                DreamProfession = ?, 
                DreamRole = ? 
            WHERE UserID = ?";
    $stmt = $pdo->prepare($sql);
    
    $executeQuery = $stmt->execute([$firstName, $lastName, $dateOfBirth, $gender, $course, $dreamProfession, $dreamRole, $userID]);

    return $executeQuery;
}

// Function to delete a user from the Users table
function deleteAUser($pdo, $userID) {
    $sql = "DELETE FROM Users WHERE UserID = ?";
    $stmt = $pdo->prepare($sql);

    $executeQuery = $stmt->execute([$userID]);

    return $executeQuery;
}

?>
