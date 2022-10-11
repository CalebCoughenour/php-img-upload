<?php
  require "header.php";
?>

<main>
  <div class="container">
    <?php
      $sql = "SELECT * FROM user";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
          $sqlImg = "SELECT * FROM profileimg WHERE userid = '$id'";
          $resultImg = mysqli_query($conn, $sqlImg);
          while ($rowImg = mysqli_fetch_assoc($resultImg)) {
            echo "<div class='row'>
                    <div class='col-lg'>
                      <div class='container'>
                        <div class='card' >
                        ";
                        if ($rowImg['status'] == 0) {
                          echo "<img src='uploads/profile".$id.".png?'".mt_rand().">";
                        } else {
                          echo "<img src='uploads/profiledefault.jpg'>";
                        }
                        echo $row['username'];
                        "</div>
                      </div>
                    </div>
                  </div>";
          }
        }
      } else {
        echo "<div class='row'>
                <div class='col-lg'>
                  <div class='card' id='home-card'>
                    <p>There are no users yet!</p>
                  </div>
                </div>
              </div>";
      }
      


      if (isset($_SESSION['id'])) {
        if ($_SESSION['id'] == 1) {
          echo "<br><br>You are logged in as user #1";
        }
        echo "<div class='row'>
                <div class='col-lg'>
                  <div class='card' id='home-card'>
                    <p>Logout As User</p>
                    <form action='logout.php' method='post'>
                      <button type='submit' name='submitLogout'>Logout</button>
                    </form>
                  </div>
                </div>
              </div>";
        echo "<div class='col-lg'>
                <div class='card' id='home-card'>
                  <form action='upload.php' method='POST' enctype='multipart/form-data'>
                    <div class='row' id='upload-row'>
                      <input type='file' name='file'>
                    </div>
                    <div class='row'>
                      <button type='submit' name='submit' class='upload-button'>Upload</button>
                    </div>
                  </form>
                </div>
              </div>";
      } else {
        echo "You are not logged in.";
        echo "<div class='row'>
                <div class='col-lg'>
                  <div class='card' id='home-card'>
                    <p>Login As User</p>
                    <form action='login.php' method='post'>
                      <button type='submit' name='submitLogin'>Login</button>
                    </form>
                  </div>
                </div>
              </div>";
        echo "
        <div class='row'>
          <div class='col-lg'>
            <div class='card' id='home-card'>
              <form action='signup.php' method='post'>
                <input type='text' name='first' placeholder='First Name'>
                <input type='text' name='last' placeholder='Last Name'>
                <input type='text' name='uid' placeholder='User Name'>
                <input type='password' name='pwd' placeholder='Password'>
                <button type='submit' name='submitSignup'>Sign Up</button>
              </form>
            </div>
          </div>
        </div>";
      }
    ?>
  </div>
</main>

<?php
  require "footer.php";
?>