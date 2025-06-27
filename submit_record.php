<?php
include 'db.php';

$pid = $_POST['patient_id'];
$diag = $_POST['diagnosis'];
$treat = $_POST['treatment'];
$pres = $_POST['prescription'];
$date = $_POST['record_date'];

$sql = "INSERT INTO MEDICALRECORDS (patient_id, diagnosis, treatment, prescription, record_date)
        VALUES ('$pid', '$diag', '$treat', '$pres', '$date')";

echo "<!DOCTYPE html>
<html>
<head>
  <title>Medical Record Entry</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f3f3f3;
      text-align: center;
      padding-top: 50px;
    }
    .box {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
      display: inline-block;
    }
    .success {
      color: green;
      font-size: 20px;
      margin-bottom: 20px;
    }
    .error {
      color: red;
      font-size: 18px;
    }
    button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
<div class='box'>";

if ($conn->query($sql) === TRUE) {
    echo "<div class='success'>Medical Record Added Successfully!</div>";
} else {
    echo "<div class='error'>Error: " . $conn->error . "</div>";
}

echo "<a href='index.html'><button>Go to Home</button></a>
</div>
</body>
</html>";

$conn->close();
?>
