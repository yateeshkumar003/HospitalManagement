<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function fetchAndDisplay($conn, $tableName, $columns, $heading) {
    echo "<h2>$heading</h2>";
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='8' cellspacing='0' style='margin-bottom: 40px; background: #fff;'>";
        echo "<tr>";
        foreach ($columns as $col) {
            echo "<th>$col</th>";
        }
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($columns as $col) {
                echo "<td>" . htmlspecialchars($row[$col]) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No records found in $tableName.</p>";
    }
}

// HTML Header
echo "<!DOCTYPE html><html><head><title>Hospital Records</title>
<style>
  body { font-family: Arial; background-color: #f2f2f2; padding: 20px; }
  h2 { color: #4CAF50; }
  table { width: 100%; border-collapse: collapse; }
  th, td { border: 1px solid #ddd; padding: 8px; }
  th { background-color: #4CAF50; color: white; }
</style>
</head><body>";

fetchAndDisplay($conn, 'patients', ['patient_id', 'patient_name', 'age', 'contact', 'disease', 'admission_date'], 'Patients');
fetchAndDisplay($conn, 'doctors', ['doctor_id', 'name', 'specialization', 'contact', 'email'], 'Doctors');
fetchAndDisplay($conn, 'appointments', ['appointment_id', 'patient_id', 'doctor_id', 'appointment_date', 'purpose'], 'Appointments');
fetchAndDisplay($conn, 'medicalrecords', ['record_id', 'patient_id', 'diagnosis', 'treatment', 'prescription', 'record_date'], 'Medical Records');
fetchAndDisplay($conn, 'billing', ['bill_id', 'patient_id', 'amount', 'payment_status', 'payment_date'], 'Billing');

echo "</body></html>";

$conn->close();
?>
