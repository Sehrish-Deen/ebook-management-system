<?php
include('navbar.php');

?>

      <div class="hero-slide owl-carousel site-blocks-cover">
        <div class="intro-section" style="background-image: url('images/book2.jpg');">
          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
                <h1>Welcome to E-Book Management System</h1>
                <p>Your Ultimate Ebook Management Solution</p>
                <p><a href="library/signup.php" class="btn btn-primary">Get Started</a></p>
              </div>
            </div>
          </div>
        </div>
        <div class="intro-section" style="background-image: url('images/oldbooks.webp');">
          <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
                <div class="intro">
                  <h1>Join Our Community</h1>
                  <p>Connect with fellow book lovers today</p>
                  <p><a href="library/signup.php" class="btn btn-primary">Get Started</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>


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

      <div class="site-section bg-light pb-0">
      
        <div class="container">
          <div class="row mb-5 justify-content-center text-center">
            <div class="col-lg-4">
              <span class="caption">Our Services</span>
              <h2 class="title-with-line text-center mb-5">What We Do</h2>                
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6">

              <div class="feature-1">
                <div class="icon-wrapper bg-primary">

                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bar-chart-line" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5h-2v12h2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                    <path fill-rule="evenodd" d="M0 14.5a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                  </svg>
                </div>
                <div class="feature-1-content">
                  <h2>E-Book Categories</h2>
                  <p>Explore diverse eBooks on our platform: Fiction, Non-Fiction, Science Fiction, and more. From nostalgic tales to mind-bending narratives, find thrilling adventures and intellectual stimulation to satisfy every literary craving.</p>
                 
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="feature-1">
                <div class="icon-wrapper bg-primary">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-life-preserver" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path fill-rule="evenodd" d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/>
                    <path d="M11.642 6.343L15 5v6l-3.358-1.343A3.99 3.99 0 0 0 12 8a3.99 3.99 0 0 0-.358-1.657zM9.657 4.358L11 1H5l1.343 3.358A3.985 3.985 0 0 1 8 4c.59 0 1.152.128 1.657.358zM4.358 6.343L1 5v6l3.358-1.343A3.985 3.985 0 0 1 4 8c0-.59.128-1.152.358-1.657zm1.985 5.299L5 15h6l-1.343-3.358A3.984 3.984 0 0 1 8 12a3.99 3.99 0 0 1-1.657-.358z"/>
                  </svg>
                </div>
                <div class="feature-1-content">
                  <h2>Collaborative Annotation Tools</h2>
                  <p>Effortlessly annotate, highlight,and share insights with our collaborative tools, enhancing your ebook management experience.Engage with fellow readers, fostering collaborative reading environment that promotes discussions. 
</p>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="feature-1">
                <div class="icon-wrapper bg-primary">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-circle-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 6a6 6 0 1 1 12 0A6 6 0 0 1 0 6z"/>
                    <path d="M12.93 5h1.57a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1.57a6.953 6.953 0 0 1-1-.22v1.79A1.5 1.5 0 0 0 5.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 4h-1.79c.097.324.17.658.22 1z"/>
                  </svg>
                </div>
                <div class="feature-1-content">
                  <h2>Digital Cataloging</h2>
                  <p>Effortlessly organize ebooks by genre, author, and tags. Enjoy advanced search and seamless cross-device access with our digital cataloging services. Streamline your reading experience and rediscover your library like never before..</p>
                </div>
              </div> 
            </div>



            <div class="col-lg-4 col-md-6">

              <div class="feature-1">
                <div class="icon-wrapper bg-primary">

                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.5 4l10-3A1.5 1.5 0 0 1 14 2.5v2h-1v-2a.5.5 0 0 0-.5-.5L5.833 4H2.5z"/>
                    <path fill-rule="evenodd" d="M1 5.5A1.5 1.5 0 0 1 2.5 4h11A1.5 1.5 0 0 1 15 5.5v8a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 13.5v-8zM2.5 5a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-11z"/>
                  </svg>
                </div>
                <div class="feature-1-content">
                  <h2>Writing Competitions</h2>
                  <p>Explore our exhilarating writing competitions, where aspiring and seasoned authors showcase their storytelling finesse. Join a community that redefining storytelling with poignant tales and mind-bending adventures.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="feature-1">
                <div class="icon-wrapper bg-primary">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-briefcase" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6h-1v6a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-6H0v6z"/>
                    <path fill-rule="evenodd" d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5v2.384l-7.614 2.03a1.5 1.5 0 0 1-.772 0L0 6.884V4.5zM1.5 4a.5.5 0 0 0-.5.5v1.616l6.871 1.832a.5.5 0 0 0 .258 0L15 6.116V4.5a.5.5 0 0 0-.5-.5h-13zM5 2.5A1.5 1.5 0 0 1 6.5 1h3A1.5 1.5 0 0 1 11 2.5V3h-1v-.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V3H5v-.5z"/>
                  </svg>
                </div>
                <div class="feature-1-content">
                  <h2>Subscription Packages</h2>
                  <p>Explore curated subscription packages for premium content and unparalleled reading experiences. Unlock a treasure trove of stories that cater to every literary whim, from heartwarming narratives to intellectual pursuits.</p>
                </div>
              </div> 
            </div>
            <div class="col-lg-4 col-md-6">
              <div class="feature-1">
                <div class="icon-wrapper bg-primary">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calculator-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12 1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                    <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-4z"/>
                  </svg>
                </div>
                <div class="feature-1-content">
                  <h2>Purchasing and Community</h2>
                  <p>Join our vibrant community celebrating storytelling and reading joy. Connect with fellow enthusiasts, authors, and readers. Explore premium and non-premium eBooks, curate your literary journey, mark favorites, and share reviews</p>
                </div>
              </div> 
            </div>

          </div>
        </div>
      </div>


      <!-- // Reviews of Client -->
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

      
  </body>

  </html>

  <?php
  include('footer.php');
  ?>