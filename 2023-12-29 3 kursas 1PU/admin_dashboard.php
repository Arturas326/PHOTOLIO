<?php
    include 'db_connect.php';
    session_start();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            header('Location: indexv1.php');
            exit;
        }
    // Read the contents of db.txt
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
    <a href="logout.php" class="w3-bar-item w3-button w3-text-grey w3-hover-black">Logout</a>
</div>
</nav>
<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1500px">
<!-- Header -->
<div class="w3-opacity">
<span class="w3-button w3-xxlarge w3-white w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></span> 
<div class="w3-clear"></div>
<header class="w3-center w3-margin-bottom">
  <h1><b>ADMIN</b></h1>
    <p><b>Welcome to login with administrator rights</b></p>
    <p class="w3-padding-16">
        <button class="w3-button w3-black" onclick="document.getElementById('id01').style.display='block'">Please add a photo</button>
    </p>
</header>
</div>
<!-- Photo Grid -->
<div class="w3-row" id="myGrid" style="margin-bottom:128px">
    <?php foreach ($photos as $photoDataString): ?>
        <?php
        $photoData = json_decode($photoDataString, true);
        if (is_array($photoData)):
            $photoPath = htmlspecialchars($photoData['path']);
            ?>
            <div class="w3-third">
                <div class="w3-container w3-margin-bottom">
                    <img src="<?php echo $photoPath; ?>" style="width:100%" alt="<?php echo htmlspecialchars($photoData['name']); ?>">
                    <p><?php echo htmlspecialchars($photoData['name']); ?></p>
                    <p><?php echo htmlspecialchars($photoData['description']); ?></p>
                    <form action='delete_photo.php' method='post'>
                        <input type='hidden' name='photo_id' value='<?php echo $photoId; ?>'>
                        <input type='submit' value='Delete' class='w3-button w3-red'>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<!-- Photo Upload Modal -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
        <div class="w3-center"><br>
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        </div>
        <form class="w3-container" action="upload_photo.php" method="post" enctype="multipart/form-data">
            <div class="w3-section">
                <label><b>Photo Name</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" name="photo_name" required>
                <label><b>Description</b></label>
                <input class="w3-input w3-border" type="text" name="description" required>
                <label><b>Select photo to upload:</b></label>
                <input class="w3-input w3-border" type="file" name="fileToUpload" id="fileToUpload">
                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Upload Photo</button>
            </div>
        </form>
    </div>
</div>
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
