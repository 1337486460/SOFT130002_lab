<?php
//Fill this place

//****** Hint ******
//connect database and fetch data here

$dbms = 'mysql';
$host = "localhost";
$user = "root";
$pass = "0601";
$database = 'travel';
$dsn="$dbms:host=$host;dbname=$database";

try {
    $pdo = new PDO($dsn, $user, $pass); //初始化一个PDO对象
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}

function findByContinent(){
    global $pdo;
    $continent = $_GET['continent'];
    $sql = "select * from imagedetails where ContinentCode = '$continent'";
    $result = $pdo->query($sql);
    $image = $result->fetch(PDO::FETCH_ASSOC);
    while ($image = $result->fetch(PDO::FETCH_ASSOC)) {
        echo <<<EOT
            <li>
              <a href='detail.php?id={$image['ImageID']}' class='img-responsive'>
                <img src='images/square-medium/{$image['Path']}' alt='{$image['Description']}'>
                <div class='caption'>
                  <div class='blur'></div>
                  <div class='caption-text'>
                    <p>{$image['Title']}</p>
                  </div>
                </div>
              </a>
            </li>      
EOT;
    }
}

function findByCountry(){
    global $pdo;
    $country = $_GET['country'];
    $sql = "select * from imagedetails where CountryCodeISO ='$country'";
    $result = $pdo->query($sql);
    $image = $result->fetch(PDO::FETCH_ASSOC);
    while ($image = $result->fetch(PDO::FETCH_ASSOC)) {
        echo <<<EOT
            <li>
              <a href='detail.php?id={$image['ImageID']}' class='img-responsive'>
                <img src='images/square-medium/{$image['Path']}' alt='{$image['Description']}'>
                <div class='caption'>
                  <div class='blur'></div>
                  <div class='caption-text'>
                    <p>{$image['Title']}</p>
                  </div>
                </div>
              </a>
            </li>      
EOT;
    }
}

function findByBoth(){
    global $pdo;
    $continent = $_GET['continent'];
    $country = $_GET['country'];
    $sql = "select * from imagedetails where CountryCodeISO ='$country' and ContinentCode = '$continent'";
    $result = $pdo->query($sql);
    $image = $result->fetch(PDO::FETCH_ASSOC);
    while($image = $result->fetch(PDO::FETCH_ASSOC)){
        echo <<<EOT
            <li>
              <a href='detail.php?id={$image['ImageID']}' class='img-responsive'>
                <img src='images/square-medium/{$image['Path']}' alt='{$image['Description']}'>
                <div class='caption'>
                  <div class='blur'></div>
                  <div class='caption-text'>
                    <p>{$image['Title']}</p>
                  </div>
                </div>
              </a>
            </li>      
EOT;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="Lab11.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php
                //Fill this place
                $sql_1 = 'select * from continents';
                $result = $pdo->query($sql_1);
                //****** Hint ******
                //display the list of continents

                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                }

                ?>
              </select>     
              
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php 
                //Fill this place
                $sql_2 = "select * from countries";
                $result = $pdo->query($sql_2);

                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value=' . $row['ISO'] . '>' . $row['CountryName'] . '</option>';
                }
                //****** Hint ******
                /* display list of countries */ 
                ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    

		<ul class="caption-style-2">
            <?php
            if(!$_GET){
                $sql = "select * from imagedetails";
                $result = $pdo->query($sql);
                $image = $result->fetch(PDO::FETCH_ASSOC);
                while ($image = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo <<<EOT
            <li>
              <a href='detail.php?id={$image['ImageID']}' class='img-responsive'>
                <img src='images/square-medium/{$image['Path']}' alt='{$image['Description']}'>
                <div class='caption'>
                  <div class='blur'></div>
                  <div class='caption-text'>
                    <p>{$image['Title']}</p>
                  </div>
                </div>
              </a>
            </li>      
EOT;
                }
            }
            else if($_GET['country']&&$_GET['continent']){
                findByBoth();
            }
            else if($_GET['country']){
                findByCountry();
            }
            else if($_GET['continent']){
                findByContinent();
            }
            //Fill this place
            //****** Hint ******
            /* use while loop to display images that meet requirements ... sample below ... replace ???? with field data
            <li>
              <a href="detail.php?id=????" class="img-responsive">
                <img src="images/square-medium/????" alt="????">
                <div class="caption">
                  <div class="blur"></div>
                  <div class="caption-text">
                    <p>????</p>
                  </div>
                </div>
              </a>
            </li>        
            */
            ?>
       </ul>       

      
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>