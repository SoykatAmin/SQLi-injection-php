<!-- src/database.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Database Users</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h2>Users Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
        </tr>

        <?php
        $conn = new PDO("pgsql:host=postgres;dbname=testdb", "testuser", "testpass");

        if (!$conn) {
            die("Connection failed");
        }

        $sql = "SELECT id, username, password FROM users";
        $stmt = $conn->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['password']."</td>";
            echo "</tr>";
        }

        $conn = null;  // Chiudi la connessione
        ?>
        <a href="index.php">Go back</a> 
    </table>
</body>
</html>
