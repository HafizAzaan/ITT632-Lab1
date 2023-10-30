<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Display</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fff9c4; 
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #f57c00; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ffd54f; 
            background-color: #fff176; 
            color: #333;
        }

        th {
            background-color: #ffb74d; 
            color: #fff;
        }

        img {
            max-width: 200px; 
            max-height: 200px; 
            display: block;
            margin: 0 auto;
            margin-top: 20px; 
            margin-bottom: 20px;
        }

        .about-me {
            margin-top: 20px;
            text-align: left;
        }

        .image-table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Biodata Display</h1>

    <?php
    // Connection parameters
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'biodata';

    // Create connection
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $sql = "SELECT * FROM biodata_table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            
            echo "<table>";
            echo "<tr><th>Name</th><th>Age</th><th>Gender</th><th>Date of Birth</th><th>Hobby</th><th>Contact Number</th></tr>";
            echo "<tr>";
            echo "<td>" . $row["name"]. "</td>";
            echo "<td>" . $row["age"]. "</td>";
            echo "<td>" . $row["gender"]. "</td>";
            echo "<td>" . $row["date_of_birth"]. "</td>";
            echo "<td>" . $row["hobby"]. "</td>";
            echo "<td>" . $row["contact_number"]. "</td>";
            echo "</tr>";
            echo "</table>";

            
            if ($row["image"]) {
                $imageData = base64_encode($row["image"]);
                echo "<div class='image-table'>";
                echo "<table>";
                echo "<tr><th>Image</th></tr>";
                echo "<tr><td><img src='data:image/jpeg;base64,$imageData' alt='Image'></td></tr>";
                echo "</table>";
                echo "</div>";
            }

            
            echo "<div class='about-me'>";
            echo "<h2>About Me</h2>";
            echo "<p>" . ($row["about_me"] ?? 'No information available') . "</p>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }

    
    $conn->close();
    ?>
</body>
</html>
