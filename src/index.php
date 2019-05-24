<?php
  if(isset($_POST["email"]) && isset($_POST["password"])){
    $host = 'mysql';
    $user = 'samuel';
    $password = 'samuel123';
    $dbname = 'db_php_web_exam';
  
    // setup mysql config for PDO
    $conf = 'mysql:host=' . $host . ';dbname=' . $dbname;
    $conn = new PDO($conf, $user, $password);
  
    // SELECT EXAMPLES
    try {
      $sql = 'SELECT * FROM user WHERE email = :email';
      $stm = $conn->prepare($sql);
      $stm->execute(['email' => $_POST["email"]]);
      $result = $stm->fetchAll();

      if(sizeof($result) == 0) {
        echo '<div class="alert alert-danger" role="alert">
              <strong>This email adress doesn\'t ring a bell!</strong> Register!
              </div>';

        // usleep(4700);
        echo("<meta http-equiv='refresh' content='1'>");
      }else{
        if(password_verify($_POST["password"], $result[0]["password"])){
          setcookie('username', $result[0]["name"], time()*60);
          setcookie('auth', true, time()*60);
          usleep(300);
          header('Location: alumni.php');
        }else {
          echo '<div class="alert alert-danger" role="alert">
                <strong>password incorrect!</strong> try harder!
                </div>';
  
          // usleep(44700);
          echo("<meta http-equiv='refresh' content='1'>");
        }

      }


    } catch(PDOException $e) {
      echo $e->message();
    }

    // $stm = $conn->query("select * from user;");
    // var_dump($stm->fetchAll());
    // insert example
    // $userDB = 'abaa cabral ';
    // $emailDB = 'samuel@samuel.dev';
    // $passwordDB = "ehuiehueh";
    // $hash = password_hash($passwordDB , PASSWORD_BCRYPT, ['cost' => 13]);
  
    // $sql = 'INSERT INTO user(name, email, password) VALUES(:user, :email, :password)';
    // $stmt = $conn->prepare($sql);
    
    // Connect to database
    // try {
      // $stmt->execute(['user' => $userDB, 'email' => $emailDB, 'password' => $hash]);
  
    // } catch(PDOException $e) {
    //   echo 'error';
    // }
  
   // check if passwords match
  //  if(password_verify("ehuiehueh", $hash)) {
  //    echo "<br> passwords match!";
  //  }
  //   echo '<br>Stmt executed successfully';
  
  }


  

  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/litera/bootstrap.min.css" rel="stylesheet" integrity="sha384-D/7uAka7uwterkSxa2LwZR7RJqH2X6jfmhkJ0vFPGUtPyBMF2WMq9S+f9Ik5jJu1" crossorigin="anonymous">
    <title>Alumni Registry</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="/">Alumni Registry</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item active">
            <?php 
              if(isset($_COOKIE["auth"])) {
                echo '<a class="nav-link" href="logout.php" formaction="logout.php">Welcome, ' . $_COOKIE["username"] . "!  <strong class='btn btn-outline-light'>Sign Out!</strong></a>";
              }else {
                echo '<a class="nav-link" href="signup.php" formaction="signup.php">What are you waiting for? <strong class="btn btn-outline-light">Sign up!</strong></a>';

              }
            ?>
          </li>
        </ul>
      </div>
    </nav>

    <header class="ml-4 text-center mt-4">
      <h2 class="text-primary">Login with your credentials</h2>
    </header>
    
    <br>

    <section class="container">
      <form class="w-50 mx-auto" method="post" action="/index.php">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-outline-primary" href="signup.php" formaction="signup.php">Sign up</a>
      </form> 

    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
  </html>