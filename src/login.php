<!-- src/login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" value="Login">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new PDO("pgsql:host=postgres;dbname=testdb", "testuser", "testpass");

        if (!$conn) {
            die("Connection failed");
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT id, username, password FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->rowCount() > 0){
            echo "Login successful!<br>";
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "id: " . $row["id"]. " - Name: " . $row["username"]. "<br>";
            }
        } else {
            echo "Invalid username or password.";
        }

        $conn = null;
    }
    ?>
    <br>
    <a href="index.php">Go back</a> 
</body>
</html>
