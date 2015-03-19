<?php

include 'header.php';

?>

    <!-- begin content -->
    <div id="site_content">
      <div id="left_content">
        <div id="blog_container">
          <div class="blog"><h2>May</h2><h3>20th</h3></div>
          <h4 class="select"><a href="blog.php">Sign In With Google+</a></h4>
          <p>Comments</a></p>
          <div class="blog"><h2>Apr</h2><h3>20th</h3></div>
          <h4><a href="blog_2004.html">Sign In With Facebook</a></h4>
          <p>Comments2</a></p>
        </div>
      </div>
      <div id="right_content">
        <div id="blog_text">
          <h1>Google+</h1>
          <center id="signinButton">
          <?php
            if ($isSignedIn) {
              echo '<b>Signed In!</b>';
            } else {
              echo '<a href="'.$authUrl.'">Sign In</a>';
            }
          ?>
          </center>
          </div>
      </div>
    </div>
    <!-- end content -->

    <!-- begin footer -->
    <footer>
      <p>Copyright &copy; 2015 Alfred. All Rights Reserved. </p>
      <p><img src="images/twitter.png" alt="twitter" />&nbsp;<img src="images/facebook.png" alt="facebook" />&nbsp;<img src="images/rss.png" alt="rss" /></p>
    </footer>
    <!-- end footer -->
    <?php include 'javascript.php'; ?>
  </div>

</body>
</html>
