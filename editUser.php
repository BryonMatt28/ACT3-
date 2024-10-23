<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 

// Check if UserID is provided
if (!isset($_GET['UserID']) || empty($_GET['UserID'])) {
    header("Location: index.php");
    exit();
}

// Fetch the user by their UserID
$userID = $_GET['UserID'];
$getUserById = getUserByID($pdo, $userID);

// If user not found, redirect to index
if (!$getUserById) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #2c3e50;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
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
    </style>
</head>
<body>
    <h1>Edit User</h1>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="UserID" value="<?php echo $getUserById['UserID']; ?>">
        
        <label for="FirstName">First Name</label>
        <input type="text" name="FirstName" id="FirstName" value="<?php echo $getUserById['FirstName']; ?>" required>
        
        <label for="LastName">Last Name</label>
        <input type="text" name="LastName" id="LastName" value="<?php echo $getUserById['LastName']; ?>" required>
        
        <label for="DateOfBirth">Date of Birth</label>
        <input type="date" name="DateOfBirth" id="DateOfBirth" value="<?php echo $getUserById['DateOfBirth']; ?>" required>
        
        <label for="Gender">Gender</label>
        <select name="Gender" id="Gender" required>
            <option value="Male" <?php echo ($getUserById['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($getUserById['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            <option value="Other" <?php echo ($getUserById['Gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
        </select>
        
        <label for="Course">Course</label>
        <input type="text" name="Course" id="Course" value="<?php echo $getUserById['Course']; ?>" required>
        
        <label for="DreamProfession">Dream Profession</label>
        <input type="text" name="DreamProfession" id="DreamProfession" value="<?php echo $getUserById['DreamProfession']; ?>" required>
        
        <label for="DreamRole">Dream Role</label>
        <input type="text" name="DreamRole" id="DreamRole" value="<?php echo $getUserById['DreamRole']; ?>" required>
        
        <input type="submit" name="editUserBtn" value="Save Changes">
    </form>
</body>
</html>