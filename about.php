<?php
include('navbar.php');
?>


      <div class="intro-section small" style="background-image: url('images/l3.webp');">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
              <div class="intro">
              <h1>About Us</h1>
              <p>Streamline your reading experience with our innovative eBook Management System—where organizing, accessing, and enjoying your digital library is effortless.</p>
              <p><a href="library/signup.php" class="btn btn-primary">Get Started</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- About us Start -->

<div class="site-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 mb-4 mb-lg-0">
              <img src="images/readbook.jpeg" alt="Image" class="img-fluid">
            </div>
            <div class="col-lg-5 ml-auto">
              <span class="caption">Benefits of Mindful Reading</span>
              <h2 class="title-with-line">Mindful Planning of reading Books</h2>


              <p class="mb-4">In today's fast-paced world, mindful reading can be a refreshing escape, helping you to fully immerse in and enjoy each book you read.E-Book Management System is here to assist you in planning and organizing your reading journey with ease and efficiency.</p>


              <div class="row">
                <div class="col-md-6">
                  <ul class="list-unstyled ul-arrow">
                    <li>Better Comprehension</li>
                    <li>Increased Enjoyment</li>
                    <li>Reduced Stress</li>
                    <li>Greater Empathy and Understanding</li>
                    <li>Improved Focus and Concentration</li>
                  </ul>

                </div>
                <div class="col-md-6">
                  <ul class="list-unstyled ul-arrow float-left">
                    <li>Inspiration and Personal Growth</li>
                    <li>Improved Relaxation</li>
                    <li>Enhanced Critical Thinking Skills</li>
                    <li>Improved Vocabulary</li>
                    <li>Enhanced Mind-Body Connection</li>
                  </ul>
                </div>
              </div>
              
              
            </div>
          </div>
        </div>
      </div>

<!-- Book Categories , Author, Book Collection getch from admin Dashboard -->

      <div class="site-section pt-0">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <div class="numbers">
              <?php  
              $conn=mysqli_connect('localhost','root','','library');
                    $bq = "select count(*) as book from tblbooks ";
                    $query = mysqli_query($conn, $bq);
                    $data = mysqli_fetch_assoc($query); ?>
                <strong class="d-block"><?php echo $data['book'];?></strong>
                <span>Book Collection</span>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="numbers">
              <?php  
                    $cq = "select count(*) as cat from tblcategory ";
                    $res = mysqli_query($conn, $cq);
                    $data = mysqli_fetch_assoc($res); ?>
                <strong class="d-block"><?php echo $data['cat'];?></strong>
                <span>Book Categories</span>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="numbers">
                <?php
              $aq = "select count(*) as author from tblauthors ";
                    $ares = mysqli_query($conn, $aq);
                    $adata = mysqli_fetch_assoc($ares);
                     ?>
                <strong class="d-block"><?php echo $adata['author'];?></strong>
                <span>Author</span>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="numbers">
                <?php
              $uq = "select count(*) as user from tblstudents";
                    $ures = mysqli_query($conn, $uq);
                    $udata = mysqli_fetch_assoc($ures); ?>
                <strong class="d-block"><?php echo $udata['user'];?></h2></strong>
                <span>Happy Readers</span>
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- Our Team -->

      <div class="site-section pb-0">
        <div class="container">
          <div class="row mb-5 justify-content-center text-center">
            <div class="col-lg-4 mb-5 text-center">
              <span class="caption">Our Team</span>
              <h2 class="title-with-line mb-2 text-center">Our Leadership</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">

              <div class="feature-1 border person text-center">
                <img src="images/person_1.jpg" alt="Image" class="img-fluid">
                <div class="feature-1-content">
                  <h2>Craig Daniel</h2>
                  <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
              <div class="feature-1 border person text-center">
                <img src="images/person_2.jpg" alt="Image" class="img-fluid">
                <div class="feature-1-content">
                  <h2>Taylor Simpson</h2>
                  <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
              <div class="feature-1 border person text-center">
                <img src="images/person_3.jpg" alt="Image" class="img-fluid">
                <div class="feature-1-content">
                  <h2>Jonas Tabble</h2>
                  <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">

              <div class="feature-1 border person text-center">
                <img src="images/person_4.jpg" alt="Image" class="img-fluid">
                <div class="feature-1-content">
                  <h2>Craig Daniel</h2>
                  <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
              <div class="feature-1 border person text-center">
                <img src="images/person_2.jpg" alt="Image" class="img-fluid">
                <div class="feature-1-content">
                  <h2>Taylor Simpson</h2>
                  <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
              <div class="feature-1 border person text-center">
                <img src="images/person_3.jpg" alt="Image" class="img-fluid">
                <div class="feature-1-content">
                  <h2>Jonas Tabble</h2>
                  <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




      <div class="intro-section small" style="background-image: url('images/b1.jpg');">
        <div class="container">
          <div class="row align-items-center justify-content-center">
            <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
              <h1>Streamline Your eBook Experience with Us </h1>
              <p>Simplify your eBook management with our expert services, ensuring an organized and accessible library for a seamless reading experience.</p>
              <p><a href="library/signup.php" class="btn btn-primary">Get Started</a></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Testimonial -->
      <div class="section-bg style-1" style="background-image: url('images/hero_1.jpg');">
        <div class="container">
          <div class="row">
            <div class="col-lg-7 text-center mx-auto">
              <span class="caption text-white">Testimonials</span>
              <h2 class="title-with-line text-center mb-5 text-white">Happy Clients</h2>
            </div>
          </div>


          <div class="owl-slide owl-carousel owl-testimonial">

          <div class="ftco-testimonial-1">
              <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                <img src="images/person_1.jpg" alt="Image" class="img-fluid mr-3">
                <div>
                  <h3>Sarah M.</h3>
                  <span>Designer</span>
                </div>
              </div>
              <div>
                <p>&ldquo;This app has completely transformed my reading habits! I love how easy it is to organize my ebooks and sync them across all my devices. The personalized recommendations have helped me discover so many amazing books I would have otherwise missed. Highly recommend!
              </div>
            </div>

            <div class="ftco-testimonial-1">
              <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                <div>
                  <h3>John D.</h3>
                  <span>Developer</span>
                </div>
              </div>
              <div>
                <p>Finding and organizing my books has never been easier. The advanced search and filters are a game changer. I also appreciate the reading progress tracker - it’s great to see my reading goals being met!</p>
              </div>
            </div>

            <div class="ftco-testimonial-1">
              <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
                <div>
                  <h3>Emily R.</h3>
                  <span>Designer</span>
                </div>
              </div>
              <div>
                <p>&ldquo;The annotation and highlight features are fantastic for my studies. I can make notes and easily reference them later, which has been incredibly helpful. Plus, the cloud sync ensures I have access to my library no matter where I am.&rdquo;</p>&rdquo;</p>
              </div>
            </div>

            <div class="ftco-testimonial-1">
              <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                <img src="images/person_3.jpg" alt="Image" class="img-fluid mr-3">
                <div>
                  <h3>David Warner</h3>
                  <span>Teacher</span>
                </div>
              </div>
              <div>
                <p>I was looking for a way to manage my vast ebook collection, and EBook Management System has exceeded my expectations. The interface is user-friendly, and the custom reading plans have kept me on track with my reading goals. A must-have for any avid reader!</p>
              </div>
            </div>

            <div class="ftco-testimonial-1">
              <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                <img src="images/person_2.jpg" alt="Image" class="img-fluid mr-3">
                <div>
                  <h3>Jame Maxwell</h3>
                  <span>Designer</span>
                </div>
              </div>
              <div>
                <p>&ldquo;The social sharing and community features are wonderful. I’ve connected with other book lovers, shared my favorite reads, and received great recommendations. It’s like having a book club in my pocket!&rdquo;</p>
              </div>
            </div>

            <div class="ftco-testimonial-1">
              <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                <img src="images/person_4.jpg" alt="Image" class="img-fluid mr-3">
                <div>
                  <h3>Allison Holmes</h3>
                  <span>Developer</span>
                </div>
              </div>
              <div>
                <p>The ebook conversion service is a lifesaver. I can easily convert my books to different formats and read them on any device I have. The support team is also very responsive and helpful whenever I have questions.</p>
              </div>
            </div>

          </div>

        </div>
            </div>

          </div>

        </div>
      </div>



  </body>

  </html>

  <?php
  include('footer.php');
  ?>