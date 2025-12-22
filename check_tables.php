<?php
require_once "includes/db/database.php";

$database = new Database();
$conn = $database->getConnection();

if ($conn) {
    echo "✅ Connected to database!<br><br>";
    
    // Check clients table
    echo "<h3>Checking 'clients' table:</h3>";
    try {
        $stmt = $conn->query("SELECT * FROM clients LIMIT 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            echo "✅ Table exists with columns:<br>";
            foreach(array_keys($row) as $column) {
                echo "- $column<br>";
            }
            
            // Count rows
            $count = $conn->query("SELECT COUNT(*) FROM clients")->fetchColumn();
            echo "<br>Total rows: " . $count . "<br>";
        } else {
            echo "Table exists but is empty.<br>";
        }
    } catch(Exception $e) {
        echo "❌ Error with clients table: " . $e->getMessage() . "<br>";
    }
    
    echo "<br><h3>Checking 'providers' table:</h3>";
    try {
        $stmt = $conn->query("SELECT * FROM providers LIMIT 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            echo "✅ Table exists with columns:<br>";
            foreach(array_keys($row) as $column) {
                echo "- $column<br>";
            }
            
            // Count rows
            $count = $conn->query("SELECT COUNT(*) FROM providers")->fetchColumn();
            echo "<br>Total rows: " . $count . "<br>";
        } else {
            echo "Table exists but is empty.<br>";
        }
    } catch(Exception $e) {
        echo "❌ Error with providers table: " . $e->getMessage() . "<br>";
    }
    
    echo "<br><hr>";
    echo "<a href='admin.php' style='color: green; font-weight: bold;'>➡️ Go to Admin Dashboard</a>";
    
} else {
    echo "❌ Database connection failed!";
}
?>