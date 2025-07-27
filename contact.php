<?php
include('navbar.php');

// Insert message data into database

$conn = mysqli_connect('localhost', 'root', '', 'library');

if (isset($_POST['send'])) {

  $name = mysqli_real_escape_string($conn, $_POST['name1']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $number = $_POST['number'];
  $msg = mysqli_real_escape_string($conn, $_POST['message']);

  $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

  if (mysqli_num_rows($select_message) > 0) {
    $message = 'Message sent already!';
  } else {
    mysqli_query($conn, "INSERT INTO `message`(name, email, number, message) VALUES('$name', '$email', '$number', '$msg')") or die('query failed');
    $message = 'Message sent successfully!';
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
if (isset($message)) {
  echo "<script>alert('$message');</script>";
}
?>

<div class="intro-section small" style="background-image: url('images/contact.jpg');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
        <div class="intro">
          <h1>Contact us</h1>
          <p>Get in touch with us for any queries or support - we're here to help!</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Message -->

<h3 class="text-center mt-5">Say Something!</h3>
<div class="site-section">
  <div class="container">
    <form action="" method="post">
      <div class="row">
        <div class="col-md-6 form-group">
          <label>Enter Your Name</label>
          <input type="text" name="name1" required placeholder="Enter your name" class="form-control">
        </div>
        <div class="col-md-6 form-group">
          <label>Enter Your Email</label>
          <input type="email" name="email" required placeholder="Enter your email" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 form-group">
          <label>Enter Your Number</label>
          <input type="number" name="number" required placeholder="Enter your number" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 form-group">
          <label for="message">Message</label>
          <textarea name="message" id="message" required placeholder="Enter your message" cols="30" rows="10" class="form-control"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <input type="submit" value="Send Message" name="send" class="btn btn-primary btn-lg px-5">
        </div>
      </div>
    </form>
  </div>
</div>


<?php
include('footer.php');
?>

<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/custom.js"></script>

</body>
</html>
