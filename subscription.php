<?php
include('navbar.php');

$conn=mysqli_connect('localhost','root','','library');
$sql = "SELECT sub_name, time_period, sub_img, charges FROM subscription";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Cards</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .card img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="intro-section small" style="background-image: url('images/subs2.jpg');">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
              <div class="intro">
                <h1>Our Subscription Plan</h1>
                <p>Explore our diverse subscription plans designed to provide access to a curated collection of premium eBooks tailored to enrich your reading experience</p>
                <p><a href="library/signup.php" class="btn btn-primary">Get Started</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>

<h1 class="text-center mt-5">Our Subscription Plan</h1>

<p class="mx-5 mt-5">Discover the perfect plan tailored to your reading needs and budget. With our flexible subscription options, you can enjoy unlimited access to a vast collection of eBooks, exclusive content, and premium features. Choose a plan that suits you best and start your literary journey today!</p>

<div class="container">
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4 ">
                    <div class="card mt-5">
                        <img src="subimages/<?php echo $row['sub_img']; ?>" alt="<?php echo $row['sub_name']; ?>">
                        <h3><?php echo $row['sub_name']; ?></h3>
                        <p><strong>Time Period:</strong> <?php echo $row['time_period']; ?></p>
                        <p><strong>Charges:</strong> <?php echo $row['charges']; ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No subscriptions found";
        }
        $conn->close();
        ?>
    </div>
</div>

<p class="mx-5 mt-3">Join our community of avid readers and elevate your reading experience with our comprehensive subscription plans. Sign up now and immerse yourself in the world of eBooks!</p>

</body>
</html>


      

  <?php
  include('footer.php');
  ?>