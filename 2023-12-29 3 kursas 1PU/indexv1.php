<?php
// Read photo details from db.txt
$photos = file_exists('db.txt') ? file('db.txt') : [];
?>
<!DOCTYPE html>
<html>
<head>
<title>PHOTOLIO</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  body,h1 {font-family: "Montserrat", sans-serif}
  img {margin-bottom: -7px}
  .w3-row-padding img {margin-bottom: 12px}
</style>
</head>
<body>
<!-- Sidebar -->
<nav class="w3-sidebar w3-black w3-animate-top w3-xxlarge" style="display:none;padding-top:150px" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-black w3-xxlarge w3-padding w3-display-topright" style="padding:6px 24px">
      <i class="fa fa-remove"></i>
    </a>
      <div class="w3-bar-block w3-center">
        <a href="#" class="w3-bar-item w3-button w3-text-grey w3-hover-black">THIS LOGIN IS ONLY FOR ADMIN</a>
          <form action="admin_login.php" method="post" class="w3-container w3-margin-top">
            <input class="w3-input" type="text" name="username" placeholder="Username" required>
            <input class="w3-input" type="password" name="password" placeholder="Password" required>
            <button type="submit" class="w3-button">Login</button>
          </form>
      </div>
</nav>
<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1500px">
<!-- Header -->
<div class="w3-opacity">
  <span class="w3-button w3-xxlarge w3-white w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></span> 
  <div class="w3-clear"></div>
    <header class="w3-center w3-margin-bottom">
      <h1><b>PHOTOLIO</b></h1>
      <p><b>A template for photographers.</b></p>
      <p class="w3-padding-16"><button class="w3-button w3-black" onclick="myFunction()">Padding</button></p>
    </header>
</div>
<!-- Photo Grid -->
<div class="w3-row" id="myGrid" style="margin-bottom:128px">
<!-- Display Photos Here -->
<?php foreach ($photos as $photoDataString): ?>
  <?php
    $photoData = json_decode($photoDataString, true);
      if (is_array($photoData)):
      $photoPath = htmlspecialchars($photoData['path']);
  ?>
<div class="w3-third photo-container">
            <img src="<?php echo $photoPath; ?>" style="width:100%" alt="<?php echo htmlspecialchars($photoData['name']); ?>">
            <div class="photo-info">
                <p class="photo-name"><?php echo htmlspecialchars($photoData['name']); ?></p>
                <p class="photo-description"><?php echo htmlspecialchars($photoData['description']); ?></p>
            </div>
        </div>
  <?php endif; ?>
  <?php endforeach; ?>
</div>
<style>
  .photo-container {
  position: relative;
  border: grey solid 0.1px;
  margin-bottom: 1px;
}
.photo-info {
  padding: 5px;
  text-align: center;
}
.photo-name, .photo-description {
  margin: 5px 0;
}
</style>
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-opacity w3-xlarge" style="margin-top:128px"> 
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>
  <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">PIT-21-I-NT</a></p>
</footer>
 
<script>
  // Toggle grid padding
  function myFunction() {
    var x = document.getElementById("myGrid");
    if (x.className === "w3-row") {
      x.className = "w3-row-padding";
    } else { 
      x.className = x.className.replace("w3-row-padding", "w3-row");
    }
  }
  // Open and close sidebar
  function w3_open() {
    document.getElementById("mySidebar").style.width = "100%";
    document.getElementById("mySidebar").style.display = "block";
  }

  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
  }
</script>

</body>
</html>
