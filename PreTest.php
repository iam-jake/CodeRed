<?php
@include 'config.php';  // Include your database configuration
session_start();  // Correct session_start
if(!isset($_SESSION['email'])){
    session_destroy();
   header("Location: index");
   exit();
}
$ExaminerName = htmlspecialchars($_SESSION['username']);
if (isset($_POST['submit'])) {

    // Collecting form data
    
    $establishment = $_POST['establishment'];
    $date = $_POST['date'];
    $score = 0;

    // Counting "Yes" answers
    for ($i = 1; $i <= 10; $i++) {
        if (isset($_POST['q' . $i]) && $_POST['q' . $i] == 'yes') {
            $score++;
        }
    }

    // Prepare SQL query to insert data into the database
    // Use prepared statements for better security
    $stmt = $conn->prepare("INSERT INTO ExamInfo (Examiner_Name, Establishment, Date_Taken, Pre_Test_Score) VALUES (?, ?, ?, ?)");
    
    // Bind parameters with proper types
    $stmt->bind_param("sssi", $ExaminerName, $establishment, $date, $score); // "ssss" means all are strings except score (int)

    if ($stmt->execute()) {
        $_SESSION['Examiner_Name']=$ExaminerName;
        $_SESSION['establishment']=$establishment;
        $_SESSION['date']=$date;
         header("Location: PostTest");
   exit();
        
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and database connectionS
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1>Code Red Pre-Test Assessment</h1>
    <section class="m-3 p-3 bg-danger-subtle">
        <form method="post">
        <div class="row">
            
            <div class="mb-3 col-md-4">
    <label for="Examinername" class="form-label">Examiner name</label>
    <input type="text" placeholder="<?php echo "$ExaminerName"; ?>" class="form-control" id="exampleInputEmail1" name="examinername" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($ExaminerName); ?>" disabled>
  </div>
  <div class="dropdown-content my-2 col-md-2">
    <label class="">Department</label>
      <select class="p-1 "id="dropdown" name="establishment" onchange="ShowDepartment()">
<option value="CSTC Junior High">CSTC Junior High</option>
<option value="CSTC Senior High">CSTC Senior High</option>
<option value="CSTC College Department">CSTC College Department</option>
  </select>
  </div>
<div class="mb-3 mt-2 col-md-2">
    <label for="date">Select a Date:</label>
        <input type="date" id="date" name="date" required>
</div>
          <p class="col-md-7">1. Have you done a fire evacuation drill?</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q1" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q1" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
  <div class="row">
          <p class="col-md-7">2. Do you know how to use a fire extinguisher?
</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q2" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q2" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
  <div class="row">
          <p class="col-md-7">3. Were you aware that using water on electrical or grease fires only makes the fire more dangerous?
</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q3" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q3" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
  <div class="row">
          <p class="col-md-7">4. Do you know what to do if you’re indoors during an earthquake?</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q4" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q4" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
  <div class="row">
          <p class="col-md-7">5. In the past year have you simulated an earthquake drill either at school or at your workplace?</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q5" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q5" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
  <div class="row">
          <p class="col-md-7">6. Are you familiar with where the specific evacuation or safety zones located in your local community are?
</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q6" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q6" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
  <div class="row">
          <p class="col-md-7">7. Do you know the emergency numbers to call the moment the accident occurs?</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q7" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q7" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
  <div class="row">
          <p class="col-md-7">8. Do you know how to react the moment you hear a fire alarm ringing?</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q8" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q8" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
  <div class="row">
          <p class="col-md-7">9. Are you aware of the fire safety procedures specific to your workplace or school?</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q9" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q9" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
  <div class="row">
          <p class="col-md-7">10. Can you do proper decision-making under pressure?</p>
        <div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q10" id="inlineRadio1" value="yes" required>
  <label class="form-check-label" for="inlineRadio1">Yes</label>
</div>
<div class="form-check form-check-inline col-md-2">
  <input class="form-check-input" type="radio" name="q10" id="inlineRadio2" value="no" required>
  <label class="form-check-label" for="inlineRadio2">No</label>
  </div>
  </div>
 <input type="submit" value="Submit" name="submit" class="btn" style="background-color: maroon; width: 100px; height: 50px; border-radius:15%;  font-weight: 900; color:white; font-size: 20px;">
 </form>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to change department dropdown text (if necessary)
        function ShowDepartment() {
            const dropdown = document.getElementById("dropdown");
            const selectedText = dropdown.options[dropdown.selectedIndex].text;
            const button = document.getElementById("dropdownButton");
            button.textContent = selectedText;
        }
    </script>

</body>
</html>