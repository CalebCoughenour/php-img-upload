<?php
  require "header.php";
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <div class="card" id="home-card">
          <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="row" id="upload-row">
              <input type="file" name="file">
            </div>
            <div class="row">
              <button type="submit" name="submit" class="upload-button">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
  require "footer.php";
?>