<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['insertNewUserBtn'])) {
        // Insert new user logic
        $firstName = trim($_POST['FirstName']);
        $lastName = trim($_POST['LastName']);
        $dateOfBirth = trim($_POST['DateOfBirth']);
        $gender = trim($_POST['Gender']);
        $course = trim($_POST['Course']);
        $dreamProfession = trim($_POST['DreamProfession']);
        $dreamRole = trim($_POST['DreamRole']);
        $dateAdded = date('Y-m-d');

        if (!empty($firstName) && !empty($lastName) && !empty($dateOfBirth) && !empty($gender) && !empty($course) && !empty($dreamProfession) && !empty($dreamRole)) {
            $query = insertIntoUserRecords($pdo, $firstName, $lastName, $dateOfBirth, $gender, $course, $dreamProfession, $dreamRole, $dateAdded);
            if (!$query) {
                $error = "Insertion failed";
            }
        } else {
            $error = "All fields are required";
        }
    } elseif (isset($_POST['editUserBtn'])) {
        // Edit user logic
        $userID = $_POST['UserID'];
        $firstName = trim($_POST['FirstName']);
        $lastName = trim($_POST['LastName']);
        $dateOfBirth = trim($_POST['DateOfBirth']);
        $gender = trim($_POST['Gender']);
        $course = trim($_POST['Course']);
        $dreamProfession = trim($_POST['DreamProfession']);
        $dreamRole = trim($_POST['DreamRole']);

        if (!empty($userID) && !empty($firstName) && !empty($lastName) && !empty($dateOfBirth) && !empty($gender) && !empty($course) && !empty($dreamProfession) && !empty($dreamRole)) {
            $query = updateAUser($pdo, $userID, $firstName, $lastName, $dateOfBirth, $gender, $course, $dreamProfession, $dreamRole);
            if (!$query) {
                $error = "Update failed";
            }
        } else {
            $error = "All fields are required";
        }
    } elseif (isset($_POST['deleteUserBtn'])) {
        // Delete user logic
        $userID = $_POST['UserID'];
        $query = deleteAUser($pdo, $userID);
        if (!$query) {
            $error = "Deletion failed";
        }
    }
}

// Fetch user for editing if UserID is provided in GET
$editUser = null;
if (isset($_GET['edit'])) {
    $editUser = getUserByID($pdo, $_GET['edit']);
}

// Fetch all users
$allUsers = seeAllUserRecords($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2 {
            color: #2c3e50;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .action-links a {
            color: #3498db;
            text-decoration: none;
            margin-right: 10px;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
        .error {
            color: #e74c3c;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Student Management System</h1>
    
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <h2><?php echo $editUser ? 'Edit Student' : 'Add New Student'; ?></h2>
    <form action="" method="POST">
        <?php if ($editUser): ?>
            <input type="hidden" name="UserID" value="<?php echo $editUser['UserID']; ?>">
        <?php endif; ?>
        <label for="FirstName">First Name</label>
        <input type="text" name="FirstName" value="<?php echo $editUser ? $editUser['FirstName'] : ''; ?>" required>
        
        <label for="LastName">Last Name</label>
        <input type="text" name="LastName" value="<?php echo $editUser ? $editUser['LastName'] : ''; ?>" required>
        
        <label for="DateOfBirth">Date of Birth</label>
        <input type="date" name="DateOfBirth" value="<?php echo $editUser ? $editUser['DateOfBirth'] : ''; ?>" required>
        
        <label for="Gender">Gender</label>
        <select name="Gender" required>
            <option value="">Select Gender</option>
            <option value="Male" <?php echo ($editUser && $editUser['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($editUser && $editUser['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            <option value="Other" <?php echo ($editUser && $editUser['Gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
        </select>
        
        <label for="Course">Course</label>
        <input type="text" name="Course" value="<?php echo $editUser ? $editUser['Course'] : ''; ?>" required>
        
        <label for="DreamProfession">Dream Profession</label>
        <input type="text" name="DreamProfession" value="<?php echo $editUser ? $editUser['DreamProfession'] : ''; ?>" required>
        
        <label for="DreamRole">Dream Role</label>
        <input type="text" name="DreamRole" value="<?php echo $editUser ? $editUser['DreamRole'] : ''; ?>" required>
        
        <input type="submit" name="<?php echo $editUser ? 'editUserBtn' : 'insertNewUserBtn'; ?>" value="<?php echo $editUser ? 'Update Student' : 'Add Student'; ?>">
    </form>

    <h2>All Students</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Course</th>
            <th>Dream Profession</th>
            <th>Dream Role</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($allUsers as $user): ?>
        <tr>
            <td><?php echo $user['UserID']; ?></td>
            <td><?php echo $user['FirstName'] . ' ' . $user['LastName']; ?></td>
            <td><?php echo $user['DateOfBirth']; ?></td>
            <td><?php echo $user['Gender']; ?></td>
            <td><?php echo $user['Course']; ?></td>
            <td><?php echo $user['DreamProfession']; ?></td>
            <td><?php echo $user['DreamRole']; ?></td>
            <td class="action-links">
                <a href="edituser.php?UserID=<?php echo $user['UserID']; ?>">Edit</a>
                <a href="#" onclick="if(confirm('Are you sure you want to delete this student?')) document.getElementById('delete-<?php echo $user['UserID']; ?>').submit();">Delete</a>
                <form id="delete-<?php echo $user['UserID']; ?>" action="" method="POST" style="display: none;">
                    <input type="hidden" name="UserID" value="<?php echo $user['UserID']; ?>">
                    <input type="hidden" name="deleteUserBtn" value="1">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
