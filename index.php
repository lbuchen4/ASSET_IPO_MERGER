<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/practice.css">
    <title>Sexy Yoga is Fake</title>
  </head>

  <!-- connect to AWS RDS db -->
  <?php
    ### try connecting to AWS DB ###

    if(isset($_SERVER['RDS_HOSTNAME'])){
      $which_db = "AWS";
      $dbhost = $_SERVER['RDS_HOSTNAME'];
      $dbport = $_SERVER['RDS_PORT'];
      $dbname = $_SERVER['RDS_DB_NAME'];
      $charset = 'utf8' ;

      $dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
      $username = $_SERVER['RDS_USERNAME'];
      $password = $_SERVER['RDS_PASSWORD'];
    } else {
      $which_db = "local";
      $dbhost = 'localhost';
      $dbport = '8080';
      $dbname = 'practice_db';
      $charset = 'utf8' ;

      $dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
      $username = 'root';
      $password = '&iaTRSb#';
    }

    try{
      $pdo = new PDO($dsn, $username, $password);
      echo "<p>You are connected to the $which_db database named $dbname.</p>";
    } catch (PDOException $e){
      $error_message = $e->getMessage();
      echo "<p>An error occurred while connecting to the $which_db database: $error_message </p>";
    }
    //first create the table if it doesn't already exist
    $sql = "CREATE TABLE homework (
      id VARCHAR (10), name VARCHAR(20), task VARCHAR(100), skill VARCHAR(30), PRIMARY KEY (id)
    )";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $statement->closeCursor();

  ?>

  <body>
    <?php
    //populate the table with a few tasks
    $tasks = array("Change the text color of this page", "Add a paragraph presenting the proof that sexy yoga prevents coronavirus", "Fix the title of this page", "Add a video to this page", "Change the font of the text on this page", "Add a background-color to the body of this page");
    $skills = array("CSS", "HTML", "HTML", "HTML", "CSS", "CSS");
    foreach($tasks as $id => $task){
      $sql = "INSERT INTO homework (id, task)
              VALUES ('$id', '$task');";
      echo $sql;
      $statement = $pdo->prepare($sql);
      $statement->execute();
      $statement->closeCursor();
    }
    foreach($skills as $id => $skill){
      $sql= "UPDATE homework
              SET skill = ('$skill')
              WHERE id = $id;";
      echo $sql;
      $statement = $pdo->prepare($sql);
      $statement->execute();
      $statement->closeCursor();
    }
    ?>
    <section id="welcome">
      <h1>BRAVE PEACOCKS</h1>
      <h2>I return.</h2>
      <p>
        Regard me. There was a powerful disturbane in the cosmic karma. <br>
        For two weeks Salvadore survived on only sexy yoga and flaming hot cheetos. <br>
        But no more is it the time for hiding! <strong>Boom.</strong> Regard me please. <strong>Boom.</strong> <br>
        Now is the time for coding. <br>
       </p>
        <!-- <img src="images/salvadore.jpg" alt="master of sexy yoga and LAMP Stack expert"> -->
       <p>
         Now that you have all flexed your sexy muscles by completing all the git, HTML, and CSS courses that I suggested...  <br>
         <em>We are ready to train!</em> Regard me please. I will allocate coding challenges to each one of you completely at random. <br>
         Those who endure their challenge with the grace of a fearless peacock will be on the way to developing the muscle memory. <br>
      </p>
    </section>
    <section class="review">
      <h2>Review</h2>
      <p>
        In case you wish to review before you attempt your challenge I have included the links to these very powerful resources once more. <br>
      </p>
      <ul>
        <li class="client"><a href="https://www.codecademy.com/catalog/language/html-css" target="_blank">HTML</a></li>
        <li class="client"><a href="https://www.codecademy.com/catalog/language/html-css" target="_blank">CSS</a></li>
        <li><a href="https://www.udacity.com/course/version-control-with-git--ud123" targhet="_blank">Git</a></li>
        <li class="client"><a href="https://www.codecademy.com/catalog/language/javascript" target="_blank">Javascript</a></li>
        <li class="server"><a href="https://www.codecademy.com/catalog/language/php" target="_blank">PHP</a></li>
        <li class="server"><a href="https://www.codecademy.com/catalog/language/sql" target="_blank">SQL</a></li>
      </ul>
    </section>
    <section class="tools">
      <h2>Tools</h2>
      <p>And again... here are the tools that each and every one of you has now downloaded to your computer machine.</p>
      <ul>
        <li><a href="https://atom.io/" target="_blank">A Text Editor</a> - to type our code in.</li>
        <li><a href="https://www.apachefriends.org/index.html" target="_blank">Xampp</a> - to communicate with the Chinese children.</li>
        <li><a href="https://classroom.udacity.com/courses/ud206" target="_blank">Access to your command line</a> - to feel like a legit hacker and use git.</li>
        <li><a href="https://github.com/" target="_blank">A Github account</a> - no relation to "the Hub" hub.</li>
      </ul>
      <p>Here is another great resource for review <a href="https://www.w3schools.com/" target="_blank">w3schools</a>.</p>
    </section>

    <section class="tasks">
      <h2>Tasks</h2>
      <p>
        Encouragement! Yes my friends. Now that you are nice and limbered up, it is time to select your challenge! <br>
        Regard me. Please type your name below the challenge you wish to tackle then click submit. <br>
        Only one each for now my brave peacocks! <br>
      </p>
      <h3>Challenges</h3>
      <?php
      //goal here is to build a table that displays the challenge and the skill type, but allows users to insert name to claim task
      $i = 1; //want to number the challenges
      $sql = "SELECT * FROM homework";
      $statement = $pdo->prepare($sql);
      $statement->execute();
      $assignments = $statement->fetchAll();
      $statement->closeCursor();

      foreach($assignments as $assignment){
        echo $i . ". " . $assignment['task'] . ". <br> Skill: " . $assignment['skill'] . "<br><br>";
        $i++;
      };

       ?>
    </section>
  </body>
</html>
