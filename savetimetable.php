<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = mysqli_connect("localhost", "root", "", "lamp_innovative");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $semester = $_POST['semester'];
    $periods = $_POST['periods'];

    $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday');

    $success = true;

    foreach ($days as $day) {
        if (isset($periods[$day])) {
            $period1 = mysqli_real_escape_string($conn, $periods[$day][0]);
            $period2 = mysqli_real_escape_string($conn, $periods[$day][1]);
            $period3 = mysqli_real_escape_string($conn, $periods[$day][2]);
            $period4 = mysqli_real_escape_string($conn, $periods[$day][3]);
            $period5 = mysqli_real_escape_string($conn, $periods[$day][4]);
            $period6 = mysqli_real_escape_string($conn, $periods[$day][5]);

            $database_name = "semester" . $semester;
            $query = "UPDATE $database_name SET 
                        period1='$period1',
                        period2='$period2',
                        period3='$period3',
                        period4='$period4',
                        period5='$period5',
                        period6='$period6' 
                      WHERE day='$day'";

            if (!mysqli_query($conn, $query)) {
                $success = false;
            }
        }
    }

    mysqli_close($conn);

    if ($success) {
        header("Location:edit_timetable.php?success=true");
    } else {
        header("Location:edit_timetable.php?success=false");
    }
    exit();
} else {
    header("Location:edit_timetable.php?success=false");
    exit();
}
