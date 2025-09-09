<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docker LAMP Stack</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .info-section {
            margin: 20px 0;
            padding: 15px;
            background: #e9f4f9;
            border-left: 4px solid #007cba;
        }
        .status {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .links {
            text-align: center;
            margin: 20px 0;
        }
        .links a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background: #007cba;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .links a:hover {
            background: #005a8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🐳 Docker LAMP Stack</h1>
        
        <div class="info-section">
            <h2>Welcome to your Docker LAMP Environment!</h2>
            <p>This is a complete LAMP (Linux, Apache, MySQL, PHP) stack running in Docker containers.</p>
        </div>

        <?php
        // Display PHP information
        echo "<div class='info-section'>";
        echo "<h3>PHP Information</h3>";
        echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
        echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
        echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
        echo "</div>";

        // Test database connection
        echo "<div class='info-section'>";
        echo "<h3>Database Connection Test</h3>";
        
        $host = 'db';
        $dbname = 'lampdb';
        $username = 'lampuser';
        $password = 'lamppass';
        
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "<div class='status success'>✅ Database connection successful!</div>";
            
            // Get some sample data
            $stmt = $pdo->query("SELECT * FROM users LIMIT 5");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if ($users) {
                echo "<h4>Sample Users from Database:</h4>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Created At</th></tr>";
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['created_at']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            
        } catch (PDOException $e) {
            echo "<div class='status error'>❌ Database connection failed: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
        echo "</div>";
        ?>

        <div class="info-section">
            <h3>Available Services</h3>
            <div class="links">
                <a href="http://localhost" target="_blank">Web Server (Port 80)</a>
                <a href="http://localhost:8080" target="_blank">phpMyAdmin (Port 8080)</a>
                <a href="info.php" target="_blank">PHP Info</a>
            </div>
        </div>

        <div class="info-section">
            <h3>Quick Start Guide</h3>
            <ol>
                <li>Place your PHP files in the <code>/www</code> directory</li>
                <li>Access your application at <a href="http://localhost">http://localhost</a></li>
                <li>Manage your database via <a href="http://localhost:8080">phpMyAdmin</a></li>
                <li>View detailed PHP configuration at <a href="info.php">info.php</a></li>
            </ol>
        </div>

        <div class="info-section">
            <h3>Development Tips</h3>
            <ul>
                <li>Database host: <code>db</code> (from within containers)</li>
                <li>Database host: <code>localhost:3306</code> (from host machine)</li>
                <li>Default database: <code>lampdb</code></li>
                <li>Default user: <code>lampuser</code> / <code>lamppass</code></li>
                <li>Files are mounted from <code>./www</code> directory</li>
            </ul>
        </div>
    </div>
</body>
</html>