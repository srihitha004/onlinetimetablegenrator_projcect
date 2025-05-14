<?php
$conn = mysqli_connect("localhost", "root", "", "lamp_innovative");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Determine the semester from the GET or POST request, default to 1 if not set
$semester = isset($_POST['semester']) ? intval($_POST['semester']) : (isset($_GET['semester']) ? intval($_GET['semester']) : 1);
$days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday');
$database_name = "semester" . $semester;

// Check if the table exists
$checkTableQuery = "SHOW TABLES LIKE '$database_name'";
$checkTableResult = mysqli_query($conn, $checkTableQuery);

if (mysqli_num_rows($checkTableResult) == 0) {
    $timetable_exists = false;
} else {
    $timetable_exists = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Timetable</title>
    <style>
        .logout {
            color: blue;
            display: block;
            margin-bottom: 20px; /* Adds space below the logout link */
        }
    </style>
</head>
<body>
    <a href="generatetimetable.php" class="logout">LOGOUT</a>
    
    <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
        <p style="color: green;">Timetable updated successfully!</p>
    <?php elseif (isset($_GET['success']) && $_GET['success'] == 'false') : ?>
        <p style="color: red;">Failed to update timetable. Please try again.</p>
    <?php endif; ?>
    
    <!-- Form to select semester -->
    <form method="post" action="edit_timetable.php">
        <label for="semester">Select Semester:</label>
        <select name="semester" id="semester" onchange="this.form.submit()">
            <?php for ($i = 1; $i <= 8; $i++): ?>
                <option value="<?php echo $i; ?>" <?php echo ($i == $semester) ? 'selected' : ''; ?>>Semester <?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </form>

    <?php if (!$timetable_exists): ?>
        <p>Timetable for Semester <?php echo $semester; ?> is not generated yet.</p>
    <?php else: ?>
        <!-- Form to edit timetable -->
        <form action="savetimetable.php" method="post">
            <input type="hidden" name="semester" value="<?php echo $semester; ?>">
            <table border="1">
                <tr>
                    <th>Day</th>
                    <th>Period 1</th>
                    <th>Period 2</th>
                    <th>Period 3</th>
                    <th>Period 4</th>
                    <th>Period 5</th>
                    <th>Period 6</th>
                </tr>
                <?php foreach ($days as $day): ?>
                    <tr>
                        <td><?php echo ucfirst($day); ?></td>
                        <?php
                        $query = "SELECT * FROM $database_name WHERE day='$day'";
                        $result = mysqli_query($conn, $query);
                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }
                        $row = mysqli_fetch_assoc($result);
                        for ($i = 0; $i < 6; $i++) {
                            $period = 'period' . ($i + 1);
                            $value = isset($row[$period]) ? htmlspecialchars($row[$period]) : '';
                            echo "<td><input type='text' name='periods[$day][$i]' value='$value'></td>";
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <button type="submit">Save Timetable</button>
        </form>
    <?php endif; ?>

</body>
</html>

<?php
mysqli_close($conn);
?>
