<?php 
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
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
        .user-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .user-info p {
            margin-bottom: 10px;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h1>Delete User</h1>
    <?php 
    // Fetch the user record based on UserID
    $getUserById = getUserByID($pdo, $_GET['UserID']); 
    ?>
    <div class="user-container">
        <div class="user-info">
            <p><strong>First Name:</strong> <?php echo $getUserById['FirstName']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $getUserById['LastName']; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo $getUserById['DateOfBirth']; ?></p>
            <p><strong>Gender:</strong> <?php echo $getUserById['Gender']; ?></p>
            <p><strong>Course:</strong> <?php echo $getUserById['Course']; ?></p>
            <p><strong>Dream Profession:</strong> <?php echo $getUserById['DreamProfession']; ?></p>
            <p><strong>Dream Role:</strong> <?php echo $getUserById['DreamRole']; ?></p>
            <p><strong>Date Added:</strong> <?php echo $getUserById['DateAdded']; ?></p>
        </div>
        <form action="core/handleForms.php?UserID=<?php echo $_GET['UserID']; ?>" method="POST">
            <input type="submit" name="deleteUserBtn" value="Delete User" class="delete-btn">
        </form>
    </div>
</body>
</html>
