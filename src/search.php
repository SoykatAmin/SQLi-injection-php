<!-- src/search.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Search User</title>
</head>
<body>
    <form method="post" action="search.php">
        <label for="search">Search for username:</label>
        <input type="text" id="search" name="search">
        <input type="submit" value="Search">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new PDO("pgsql:host=postgres;dbname=testdb", "testuser", "testpass");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $search = $_POST['search'];
        $sql = "SELECT * FROM users WHERE username LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "id: " . $row["id"]. " - Name: " . $row["username"]. "<br>";
            }
        } else {
            echo "0 results";
        }

        $conn->null;
    }
    ?>
    <a href="index.php">Go back</a> 
</body>
</html>
