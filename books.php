<?php
include('navbar.php');
$conn = mysqli_connect('localhost', 'root', '', 'library');

// Update SQL query to join tables
$sql = "SELECT tblbooks.BookName, tblbooks.cover_img, tblauthors.AuthorName, tblcategory.CategoryName 
        FROM tblbooks 
        JOIN tblauthors ON tblbooks.AuthorId = tblauthors.id 
        JOIN tblcategory ON tblbooks.CatId = tblcategory.id";

$result = $conn->query($sql);
?>

<div class="intro-section small" style="background-image: url('images/library1.webp');">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
                <div class="intro">
                    <h1>Endless Adventures</h1>
                    <p>Unlock a world of adventure, knowledge, and imagination—borrow a book from our library today!</p>
                    <p><a href="library/signup.php" class="btn btn-primary">Get Started</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<h1 class="text-center mt-5">Discover Your Next Great Read</h1>

<p class="mx-5">Explore our diverse collection of books, meticulously curated to ignite your passion for reading. Whether you're looking for an enthralling adventure, a heartwarming romance, or a thought-provoking non-fiction, our library has something for everyone.</p>

<h4 class="mx-5">Why Choose Us?</h4>

<ul class="mt-3 mx-4">
  <li><h6>Vast Collection:</h6> <span>Thousands of titles across various genres, ensuring there's something for every reader.</span></li>
  <li><h6>Expert Recommendations:</h6> <span>Handpicked books suggested by our literary experts to guide you to your next favorite read.</span></li>
  <li><h6>Exclusive Content:</h6> <span>Access to exclusive eBooks and early releases that you won't find anywhere else.</span></li>
  <li><h6>Community Reviews:</h6> <span>Read reviews from fellow book lovers and share your own thoughts to help others find great books.</span></li>
</ul>

<!-- All Books Fetch from admin  Dashboard -->

<h1 class="text-center">LATEST ARRIVALS</h1>

<div class="container mt-5">
    <div class="row">

    
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="uploads/books/<?php echo $row['cover_img']; ?>" class="card-img-top" alt="Book Cover">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['BookName']; ?></h5>
                            <p class="card-text">Author: <?php echo $row['AuthorName']; ?></p>
                            <p class="card-text">Category: <?php echo $row['CategoryName']; ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No books found</p>";
        }
        ?>
    </div>
</div>

<h3 class="text-center mt-2">Start Your Journey</h3>

<p class="mx-5">Ready to embark on your next literary adventure? Browse through our extensive catalog, select a book that catches your eye, and get lost in its pages. From bestsellers to hidden gems, our collection is here to inspire and entertain you.</p>


<h3 class="text-center mt-5 ">Join Our Reading Community</h3>

<p class="mx-5 mb-3">Become a part of our vibrant reading community. Share your favorite books, join discussions, and connect with other book enthusiasts. Your next great story awaits!</p>


<?php
include('footer.php');
?>
