<?php
// Include the database connection file
include 'db.php';

// Start the session to get the worker_id (assuming worker_id is stored in the session)
session_start();
if (!isset($_SESSION['worker_id'])) {
    die("Worker not logged in.");
}
$worker_id = $_SESSION['worker_id'];

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    // Update worker status in the database
    $sql = "UPDATE workers SET status = ? WHERE worker_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $status, PDO::PARAM_STR);
    $stmt->bindParam(2, $worker_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Status updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating status.');</script>";
    }
    $stmt->closeCursor();
}

// Fetch worker status from the database
$sql = "SELECT status FROM workers WHERE worker_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $worker_id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$status = $result ? $result['status'] : 'active';
$stmt->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #E1EACD;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 10px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        #main-content {
            padding: 20px;
            background-color: rgb(230, 246, 229);
        }
        .slider {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: auto;
            overflow: hidden;
            border: 2px solid #ddd;
            border-radius: 10px;
        }
        .slides {
            display: flex;
            width: 300%;
            animation: slide 2s infinite;
        }
        .slides img {
            width: 100%;
            flex-shrink: 0;
        }
        @keyframes slide {
            0%, 33.33% {
                transform: translateX(0);
            }
            33.34%, 66.66% {
                transform: translateX(-100%);
            }
            66.67%, 100% {
                transform: translateX(-200%);
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="worker_dashboard.php">Local-Hand</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                        <a class="nav-link" href="market.php"> Market </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="job_request.php">Job Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Previous Works</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="worker_feedback.php">Feedbacks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="worker_profile.php">Manage Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Salary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="h&p.php">Help Support</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="" class="form-inline">
                            <select id="status" name="status" class="form-control" onchange="this.form.submit()">
                                <option value="active" <?php echo ($status === 'active') ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?php echo ($status === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </form>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="main-content">
        <h2>Welcome</h2>
        <!--<div class="slider">
            <div class="slides">
                <img src="image/worker1.jpg" alt="Image 1">
                <img src="image/worker2.webp" alt="Image 2">
                <img src="image/worker3.jpeg" alt="Image 3">
            </div>
        </div> -->
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
