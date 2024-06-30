<!-- src/details.php -->
<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
</head>
<body>
    <form method="post" action="details.php">
        <label for="id">Enter user ID:</label>
        <input type="text" id="id" name="id">
        <input type="submit" value="Get Details">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new PDO("pgsql:host=postgres;dbname=testdb", "testuser", "testpass");

        if (!$conn) {
            die("Connection failed");
        }

        // Vulnerable code: directly using user input without sanitization
        $id = $_POST['id'];
        $sql = "SELECT * FROM users WHERE id=$id"; // Vulnerable to SQL Injection
        $stmt = $conn->query($sql);

        if ($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "id: " . $row["id"]. " - Name: " . $row["username"]. " - Password: " . $row["password"]. "<br>";
            }
        } else {
            echo "0 results";
        }

        $conn = null;
    }
    ?>
    <a href="index.php">Go back</a> 
</body>
</html>
