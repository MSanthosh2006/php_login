<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once("dbconnection.php");

/* SAFE SESSION ACCESS */
$usertype = $_SESSION["usertype"] ?? "Admin";
$userid   = $_SESSION["userid"] ?? null;

/* ADMIN → ALL USERS */
if ($usertype === "Admin") {
    $sql = "
    SELECT u.userid, u.username,
           m.mark1, m.mark2, m.mark3,
           m.total, m.avg, m.grade
    FROM tbl_marks m
    JOIN tbl_user u ON m.userid = u.userid
    ";
}
/* USER → ONLY OWN DATA */
else {
    $sql = "
    SELECT u.userid, u.username,
           m.mark1, m.mark2, m.mark3,
           m.total, m.avg, m.grade
    FROM tbl_marks m
    JOIN tbl_user u ON m.userid = u.userid
    WHERE m.userid = '$userid'
    ";
}

$result = mysqli_query($conn, $sql);
if (!$result) {
    die(mysqli_error($conn));
}

/* Grade conversion */
function gradeValue($g) {
    if ($g == 'A') return 90;
    if ($g == 'B') return 75;
    if ($g == 'C') return 60;
    return 40;
}

/* ARRAYS */
$names = $mark1s = $mark2s = $mark3s = $totals = $avgs = $grades = [];

/* ✅ ONLY PLACE WHERE $row IS USED */
while ($row = mysqli_fetch_assoc($result)) {

    $names[]  = $row['username'] . " (ID:" . $row['userid'] . ")";

    $mark1s[] = (int)$row['mark1'];
    $mark2s[] = (int)$row['mark2'];
    $mark3s[] = (int)$row['mark3'];
    $totals[] = (int)$row['total'];
    $avgs[]   = (float)$row['avg'];
    $grades[] = gradeValue($row['grade']);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Marks Report</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
<div style="
    background:#1e3a8a;
    color:white;
    padding:10px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
">
    <span>Welcome : Admin</span>
    <a href="logout.php"
       style="
       color:white;
       text-decoration:none;
       font-weight:bold;
       background:red;
       padding:6px 12px;
       border-radius:4px;
       ">
       Logout
    </a>
</div>



<h2>Marks Report</h2>

<canvas id="chart" width="700" height="350"></canvas>

<script>
new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($names); ?>,
        datasets: [
            {
                label: 'Mark 1',
                data: <?php echo json_encode($mark1s); ?>,
                backgroundColor:'rgba(238, 0, 255, 1)'
            },
            {
                label: 'Mark 2',
                data: <?php echo json_encode($mark2s); ?>,
                backgroundColor:'rgba(92, 252, 0, 1)   '
            },
            {
                label: 'Mark 3',
                data: <?php echo json_encode($mark3s); ?>,
                backgroundColor:'rgba(91, 9, 255, 1)'
            },
            {
                label: 'Total',
                data: <?php echo json_encode($totals); ?>,
                backgroundColor:'rgba(255, 133, 10, 1)'
            },
            {
                label: 'Average',
                data: <?php echo json_encode($avgs); ?>,
                backgroundColor:'rgba(2, 2, 250, 1)'
            },
            {
                label: 'Grade (Scale)',
                data: <?php echo json_encode($grades); ?>,
                backgroundColor:'rgba(255, 6, 60, 1) '
            }
        ]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

</body>
</html>
