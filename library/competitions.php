<?php
session_start();
include('includes/config.php');

if(strlen($_SESSION['login'])==0) {   
    header('location:index.php');
    exit(); // Add exit after header redirect to prevent further execution
}

$sid = $_SESSION['stdid'];

// Fetch competitions data
$sql = "SELECT * FROM competitions WHERE status = 'active'";
$query = $dbh->prepare($sql);
$query->execute();
$competitions = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ebook Management System | Competitions</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
        .card {
            margin: 20px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background-color: #f8f8f8;
        }
        .card-body {
            padding: 15px;
            text-align: center;
        }
        .card-title {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 1em;
            margin-bottom: 10px;
        }
        .timer {
            font-size: 1em;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="container">
        <h2>Competitions</h2>
        <?php if (isset($_SESSION['error_msg'])) : ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error_msg']; ?>
            </div>
            <?php unset($_SESSION['error_msg']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success_msg'])) : ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success_msg']; ?>
            </div>
            <?php unset($_SESSION['success_msg']); ?>
        <?php endif; ?>
        
        <div class="row">
            <?php if (!empty($competitions)) : ?>
                <?php foreach ($competitions as $competition) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <?php if(!empty($competition->comp_img)): ?>
                                <img class="card-img-top" src="admin/uploads/books/<?php echo htmlentities($competition->comp_img); ?>" alt="<?php echo htmlentities($competition->Title); ?>">
                            <?php else: ?>
                                <img class="card-img-top" src="path/to/default-image.jpg" alt="No image available">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlentities($competition->Title); ?></h5>
                                <p class="card-text"><?php echo htmlentities($competition->Description); ?></p>
                                <p class="card-text">Start Date: <?php echo htmlentities($competition->StartDate); ?></p>
                                <p class="card-text">End Date: <?php echo htmlentities($competition->EndDate); ?></p>
                                <?php
                                    $endDate = strtotime($competition->EndDate);
                                    $isExpired = $endDate < time();
                                    if (!$isExpired) {
                                        $countdownSeconds = $endDate - time();
                                ?>
                                        <p class="timer" id="timer-<?php echo $competition->Competition_ID; ?>"></p>
                                <?php } else { ?>
                                        <p class="timer">Expired</p>
                                <?php } ?>
                                <form method="POST" action="participate.php">
                                    <input type="hidden" name="competition_id" value="<?php echo $competition->Competition_ID; ?>">
                                    <button type="submit" class="btn btn-primary">Participate</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        function startTimer(duration, display) {
                            var timer = duration, days, hours, minutes, seconds;
                            setInterval(function () {
                                days = parseInt(timer / (60 * 60 * 24), 10);
                                hours = parseInt((timer % (60 * 60 * 24)) / (60 * 60), 10);
                                minutes = parseInt((timer % (60 * 60)) / 60, 10);
                                seconds = parseInt(timer % 60, 10);

                                days = days < 10 ? "0" + days : days;
                                hours = hours < 10 ? "0" + hours : hours;
                                minutes = minutes < 10 ? "0" + minutes : minutes;
                                seconds = seconds < 10 ? "0" + seconds : seconds;

                                display.textContent = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

                                if (--timer < 0) {
                                    timer = duration;
                                }
                            }, 1000);
                        }

                        window.onload = function () {
                            <?php if (!$isExpired) { ?>
                                var endDate = <?php echo $endDate - time(); ?>;
                                var display = document.querySelector('#timer-<?php echo $competition->Competition_ID; ?>');
                                startTimer(endDate, display);
                            <?php } ?>
                        };
                    </script>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-md-12">
                    <div class="alert alert-info">
                        No active competitions available.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
