<!-- src/insert.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Insert User</title>
</head>
<body>
    <form method="post" action="insert.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <label for="password">Password:</label>
        <input type="text" id="password" name="password">
        <input type="submit" value="Insert">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new PDO("pgsql:host=postgres;dbname=testdb", "testuser", "testpass");

        if (!$conn) {
            die("Connection failed");
        }

        // Vulnerable code: directly using user input without sanitization
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')"; // Vulnerable to SQL Injection
        $stmt = $conn->exec($sql); 

        if ($stmt) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->errorInfo()[2];
        }

        $conn = null;
    }
    ?>

    <a href="index.php">Go back</a> <!-- Aggiunto il link per tornare indietro -->
</body>
</html>
