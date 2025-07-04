<?php
@include 'config.php'; // Include your database configuration

session_start(); // Start the session

if (!isset($_SESSION['email'])) {
    session_destroy();
    header("Location: index");
    exit();
}

// Fetch unique establishments for the dropdown
$establishments_query = "SELECT DISTINCT Establishment FROM ExamInfo";
$establishments_result = $conn->query($establishments_query);

// Handle filtering
$selected_establishment = isset($_GET['establishment']) ? $_GET['establishment'] : '';
$sql = "SELECT ExamInfo.*, Score.Post_Test_Score 
        FROM ExamInfo 
        LEFT JOIN Score ON ExamInfo.id = Score.id";

// Add WHERE clause if filtering by establishment
if (!empty($selected_establishment)) {
    $sql .= " WHERE ExamInfo.Establishment = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selected_establishment);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="RED.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: maroon;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
     <div class="row nav">
        <div class="col-md-2 mt-1">
            <div class="cardtextcntrsidebar navbar navbar-expand-lg bg-body-tertiary">
                <div class="card-body">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <div class="mt-1">
                        <h3 class="mt-1"><?php echo htmlspecialchars($username); ?></h3>
                        <hr>
                        <a href="Home" class="nav-link"><h5>Home</h5></a>
			<a href="UserProfile" class="nav-link"><h5>Profile</h5></a>
 			<a href="SetupProfile" class="nav-link"><h5>Account Settings</h5></a>
                        <a href="Modules" class="nav-link"><h5>Modules</h5></a>
			<a href="Charts.php" class="nav-link active"><h5>Scores</h5></a>
                        <a href="index" class="nav-link"><h5>Sign Out</h5></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-8 mt-1">
            <div class="card mb-3 content">
                    <!-- Filter Form -->
        <form method="GET" action="" class="mb-3">
            <label for="establishment">Filter by Establishment:</label>
            <select name="establishment" id="establishment" class="form-select w-25 d-inline-block">
                <option value="">-- Select Establishment --</option>
                <?php
                if ($establishments_result && $establishments_result->num_rows > 0) {
                    while ($row = $establishments_result->fetch_assoc()) {
                        $selected = ($row['Establishment'] === $selected_establishment) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($row['Establishment']) . "' $selected>" . htmlspecialchars($row['Establishment']) . "</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

    <hr>
                <?php
    if ($result && $result->num_rows > 0) {
        echo "<table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Examiner Name</th>
                        <th>Establishment</th>
                        <th>Date Taken</th>
                        <th>Pre-Test Score</th>
                        <th>Post-Test Score</th> <!-- Column from Table2 -->
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['Examiner_Name']) . "</td>
                    <td>" . htmlspecialchars($row['Establishment']) . "</td>
                    <td>" . htmlspecialchars($row['Date_Taken']) . "</td>
                    <td>" . htmlspecialchars($row['Pre_Test_Score']) . "</td>
                    <td>" . htmlspecialchars($row['Post_Test_Score']) . "</td> <!-- Display Post Test Score -->
                  </tr>";
        }
        echo "</tbody>
            </table>";
    } else {
        echo "No records found.";
    }

    // Close the database connection
    $conn->close();
    ?>
            </div>
        </div>       
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>
</html><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></script>
</body>
</html>
