<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
    
</head>
<body>
  <div class="navbar">
  <a href="index.php">Home</a>
    <a href="logout.php"> log out</a>
    <a href="../speler/speleroverzicht.php"> overzicht spelers </a>
    <a href="../school/schooloverzicht.php"> overzicht school </a>
    <a href="../toernooi/toernooioverzicht.php"> overzicht toernooi </a>
  </div>
  <div class="h1"> 
    <h1> you have logged in </h1>
  </div>
  <?php 
        Session_start();
        if (isset($_SESSION['gebruikersnaam'])) {
            echo '<h1>hello ' . $_SESSION['gebruikersnaam'] . '!</h1> ';
        }
        
    ?>
  </div>
  <div class="footer">
  </div>
</body>
</html> 