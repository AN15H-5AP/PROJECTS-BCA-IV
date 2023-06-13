<?php
session_start();
include('./Database/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <div class="navbarflow">
        <div class="logo">
            <a href="index.php">
                <img src="./images/logo.svg" alt="company logo">
            </a>
        </div>

        <div class="links">
            <a href="index.php">Home</a>
            <a href="job_blogs.php">Blog</a>
            <a href="">Contact</a>
            <a href="">About us</a>
        </div>

        <div class="navbutton">
            <?php if (!isset($_SESSION['email'])) { ?>
                <div class="signin">
                    <a href="job_seekerlogin.php">
                        <button type="submit"><img src="./images/sign in.png" height="13px" width="13px" style="align-items: center;"> Sign in</button>
                    </a>
                </div>
                <div class="signup">
                    <a href="company-registration.php">
                        <button type="submit"><img src="./images/post.png" width="13px" height="13px" alt=""> Post
                            Job</button>
                    </a>
                </div>
            <?php } else { ?>
                <div class="afterlogin">
                    <img src="./images/Account icon.svg" alt="#" class="test">
                    <div class="dropdown">
                        <a href="companyprofile.php"><button>profile</button></a>
                        <a href="sessiondestroy.php"><button>Log out</button></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


    <div class="mainimage">
        <div class="image"><img src="./images/man2.jpg" width="100%" height="550px" alt=""></div>
        <div class="text">
            <p class="text1">Discover your <span style="color: #B4710D;"> Dream Job</span> <br>
                Explore opportunities Across <br>
                industries and location</p><br> <br>

            <p class="text2">Find Your Perfect Fit with Our User-Friendly <br>
                Platform and Personalized Job Recommendations</p>


            <form action="" class="searching" method="post">

                <label for="job title"></label>
                <input type="text" class="jobs" id="jobs" placeholder="Job tilte">

                <label for="job category"></label>
                <select name="category" id="category">
                    <option value="Category">Select category</option>
                    <option value="IT&Telecommunication">IT&Telecommunication</option>
                    <option value="Graphic Designing">Design/Graphics</option>
                    <option value="finance">Account/Finance</option>
                    <option value="Medical">Medical</option>
                    <option value="NGO/ING">NGO/ING</option>
                    <option value="Engineering/Architectures">Engineering/Architectures</option>
                    <option value="Tou/Travel">Tour/Travel</option>
                    <option value="E-comerce">E-comerce</option>
                </select>

                <button type="submit"> <img src="./images/search.png" height="14px" width="14px" alt=""> Search</button>
            </form>
        </div>
    </div>


    <section id="trendingjob">
        <p class="trendingtext">Trending <span>Jobs</span></p>
        <!-- main div-->
        <?php
        $sql = "SELECT j.job_title,j.job_address,j.job_type,j.deadline_date,j.job_id,c.company_name,c.Image_name from company c 
        Inner JOIN job j ON c.company_id = j.companyID 
         where deadline_date >= CURDATE() ORDER BY RAND()";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="trendingjob">
                <div class="cards">
                    <?php echo '<a href="jobdescription.php?job_id=' . $row['job_id'] . '">' ?>
                    <!--contents -->
                    <div class="cardscontent">
                        <div class="imagearea">
                            <div class="companyimg">
                                <?php echo '<img src="./images/uploaded_image/' . $row['Image_name'] . '"alt="">' ?>
                            </div>
                            <div class="companyname">
                                <li>
                                    <?php echo $row['job_title']; ?>
                                </li>
                                <li>
                                    <?php echo $row['company_name']; ?>
                                </li>
                            </div>
                        </div>
                        <div class="info">
                            <li>
                                <?php echo "location:" . $row['job_address']; ?>
                            </li>
                            <li>
                                <?php echo "Job-type:" . $row['job_type']; ?>
                            </li>
                            <li>
                                <?php
                                $deaddate = $row['deadline_date'];
                                $deadstamp = strtotime($deaddate);
                                $dead = date('Y-m-d', $deadstamp);
                                echo "Deadlinedate:" . $dead;
                                ?>
                            </li>
                        </div>
                        <?php echo '<a href="jobdescription.php?jobid=' . $row['job_id'] . '">
                                <button>Apply</button>
                            </a>' ?>
                    </div>
                    <?php echo '</a>' ?>
                </div>

            </div>
        <?php } ?>
    </section>

    <section id="featurejobs">
        <p class="featuretext">Featured <span>Jobs</span></p>
        <!-- main div-->
        <div class="featurejob">
            <div class="cards">
                <a href="jobdescription.php">
                    <!--contents -->
                    <div class="cardscontent">
                        <div class="imagearea">
                            <div class="companyimg">
                                <img src="./images/esewa.svg" alt="">
                            </div>
                            <div class="companyname">
                                <li>Ui/UX Designer</li>
                                <li>Kathmandu</li>
                            </div>
                        </div>
                        <div class="info">
                            <li>location:</li>
                            <li>Job-type:</li>
                            <li>Deadline:</li>
                        </div>
                        <a href="">
                            <button>Apply</button>
                        </a>
                    </div>
                </a>
            </div>

        </div>
    </section>

    <section id="trustedcompany">
        <div class="trusted">
            <img src="./images/esewa.svg" alt="">
            <img src="./images/esewa.svg" alt="">
            <img src="./images/esewa.svg" alt="">
            <img src="./images/esewa.svg" alt="">
            <img src="./images/esewa.svg" alt="">
            <img src="./images/esewa.svg" alt="">
        </div>
    </section>


    <section id="dreamjob">
        <p>Are you Looking for Dream job?</p>
        <a href="index.php"><button>Find Now</button></a>
    </section>





    <footer>
        <div class="footer">
            <div class="footercontent">
                <div class="aboutus">
                    <h2>About Us</h2>
                    <a href="">About Insearch</a>
                    <a href="">Privacy Policy</a>
                    <a href="">About Insearch</a>
                    <a href="">Terms & Conditions</a>
                    <a href="">Blogs</a>
                </div>
                <div class="jobseeker">
                    <h2>Job Seeker</h2>
                    <a href="job_seekerregistration.php">Register</a>
                    <a href="job_seekerlogin.php">Sign In</a>
                    <a href="index.php">Search Job</a>
                </div>
                <div class="company">
                    <h2>Company</h2>
                    <a href="company-registration.php">Register Company</a>
                    <a href="company-login.php">Login as company</a>
                    <a href="index.php">Browse jobs</a>
                    <a href="company-login.php">Post Jobs</a>
                </div>
                <div class="sociallinks">
                    <h2>Socail Links</h2>
                    <div class="upper">
                        <a href="https://facebook.com"><img src="./images/facebook.svg" width="30px" height="30px" alt=""></a>
                        <a href="https://linkedin.com"><img src="./images/linkedin.svg" width="30px" height="30px" alt=""></a>
                    </div>
                    <div class="lower">
                        <a href="https://instagram.com"><img src="./images/instagram.svg" width="30px" height="30px" alt=""></a>
                        <a href="https://twitter.com"><img src="./images/twitter.svg" width="30px" height="30px" alt=""></a>
                    </div>
                </div>
                <div class="contactus">
                    <h2>Contact us</h2>
                    <a href="">koteshwore Kthamndu Nepal</a>
                    <a href="">+977-011234567</a>
                    <a href="">insearch@gmail.com</a>
                </div>
            </div>
            <div class="copyright">
                <p>&copy;
                    <?php echo date('Y'); ?> All rights with insearch
                </p>
            </div>
        </div>
    </footer>
</body>

</html>