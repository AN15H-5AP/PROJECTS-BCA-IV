<?php
session_start();
include ('./Database/connection.php');
if(!isset($_SESSION['email'])){
  header("location:company-login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./styles/index.css" />
</head>

<body>
  <?php include ('afterloginnav.php') ?>
  <?php echo $_SESSION['email']; ?>
  <!-- End of the navbar -->
  <div class="imagesection">
    <!-- image section -->
    <div class="image1">
      <img src="./images/man2.jpg" alt="#" height="585px" width="100%" />
    </div>
    <div class="imgtext">
      <p class="text1">
        Discover your Dream job <br />Explore opportunities Across
        <br />industries and location
      </p>
      <br />
      <p class="text2">
        Find your Perfect fit with our user-friendly <br />Platform and
        personilized job Recommendation
      </p>
    </div>
    <!-- search bar -->
    <div class="title">
      <input type="text" id="job_title" placeholder="Job Title" />
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
      <!-- search image input -->
      <button type="submit">
        <!-- <img src="search.png" alt="#" width="14px" height="14px"> -->
        Search
      </button>
    </div>
  </div>
  <!-- header image end -->

  <!-----------------------------------trending jobs----------------------------------------------->

  <section id="trendingjobs">
    <div class="main-trendingjobs">
      <p class="sectiontext"><span>Trending</span> Jobs</p>
      <div class="trendingjobs">
        <!-- first trending job  -->
        <a href="jobdescription.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Esewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
        <!-- second trending job -->
        <a href="login.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Esewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
        <!-- third trending job -->
        <a href="login.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Esewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
        <!-- fourth trending job -->
        <a href="login.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Esewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
        <a href="login.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Esewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>

  <!-------------------------featured jobs------------------------->
  <section id="featuredjobs">
    <div class="main-featuredjobs">
      <p class="sectiontext"><span>Featured</span> Jobs</p>
      <div class="trendingjobs">
        <!-- first trending job  -->
        <a href="jobdescription.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Eewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
        <!-- second trending job -->
        <a href="login.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Esewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
        <!-- third trending job -->
        <a href="login.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Esewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
        <!-- fourth trending job -->
        <a href="login.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Esewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
        <a href="login.html">
          <div class="trendingjobs1">
            <div class="trending-inside">
              <div class="trendingjob-title">
                <div class="company-logo">
                  <img src="./images/esewa.png" alt="company logo" class="companylogo" />
                </div>
                <div class="jobtitle">
                  <div class="job-title">
                    <p>UI/UX Designer</p>
                  </div>
                  <div class="job-company">Esewa</div>
                </div>
              </div>
              <div class="jobdesription">
                <div class="job-description">
                  <ul>
                    <li>location: kathmandu, Nepal</li>
                    <li>Job Type: Full-time</li>
                    <li>Deadline:2020-02-12</li>
                  </ul>
                </div>
                <div class="jobapply">
                  <a href="login.html">
                    <button type="submit">Apply</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </section>


  <!--------------------------------trusted companies------------------------>
  <section id="trusted-companies">
    <div class="trustedcompanies">
      <p class="sectiontext"><span>Trusted</span>companies</p>
      <div class="companies">
        <img src="./images/esewa.svg" alt="#">
        <img src="./images/esewa.svg" alt="#">
        <img src="./images/esewa.svg" alt="#">
        <img src="./images/esewa.svg" alt="#">
        <img src="./images/esewa.svg" alt="#">
      </div>
    </div>

  </section>

  <section id="footer">
  </section>


</body>

</html>