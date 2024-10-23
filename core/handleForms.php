<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

// Handle Insert New User
if (isset($_POST['insertNewUserBtn'])) {
    $firstName = trim($_POST['FirstName']);
    $lastName = trim($_POST['LastName']);
    $dateOfBirth = trim($_POST['DateOfBirth']);
    $gender = trim($_POST['Gender']);
    $course = trim($_POST['Course']);
    $dreamProfession = trim($_POST['DreamProfession']);
    $dreamRole = trim($_POST['DreamRole']);
    $dateAdded = date('Y-m-d'); // Set current date as DateAdded

    // Ensure all fields are filled
    if (!empty($firstName) && !empty($lastName) && !empty($dateOfBirth) && !empty($gender) && !empty($course) && !empty($dreamProfession) && !empty($dreamRole)) {

        // Call the function to insert a new user
        $query = insertIntoUserRecords($pdo, $firstName, $lastName, $dateOfBirth, $gender, $course, $dreamProfession, $dreamRole, $dateAdded);

        if ($query) {
            header("Location: ../index.php"); // Redirect to index after successful insert
        } else {
            echo "Insertion failed";
        }
    } else {
        echo "Make sure that no fields are empty";
    }
}

// Handle Edit User
if (isset($_POST['editUserBtn'])) {
    $userID = $_POST['UserID'];
    $firstName = trim($_POST['FirstName']);
    $lastName = trim($_POST['LastName']);
    $dateOfBirth = trim($_POST['DateOfBirth']);
    $gender = trim($_POST['Gender']);
    $course = trim($_POST['Course']);
    $dreamProfession = trim($_POST['DreamProfession']);
    $dreamRole = trim($_POST['DreamRole']);

    // Ensure all fields are filled
    if (!empty($userID) && !empty($firstName) && !empty($lastName) && !empty($dateOfBirth) && !empty($gender) && !empty($course) && !empty($dreamProfession) && !empty($dreamRole)) {

        // Call the function to update the user
        $query = updateAUser($pdo, $userID, $firstName, $lastName, $dateOfBirth, $gender, $course, $dreamProfession, $dreamRole);

        if ($query) {
            header("Location: ../index.php"); // Redirect to index after successful update
            exit();
        } else {
            echo "Update failed";
        }
    } else {
        echo "Make sure that no fields are empty";
    }
}
// Handle Delete User
if (isset($_POST['deleteUserBtn'])) {
    $userID = $_GET['UserID'];

    // Call the function to delete the user
    $query = deleteAUser($pdo, $userID);

    if ($query) {
        header("Location: ../index.php"); // Redirect to index after successful deletion
    } else {
        echo "Deletion failed";
    }
}

?>