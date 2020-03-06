<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/practice.css">
    <title>Weenie Hut Haqs</title>
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
    $sql = "CREATE TABLE participants (
      name VARCHAR(20)
    )";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $statement->closeCursor();
  ?>

  <body>
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
      <h2>Languages</h2>
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
      <p>
        The <span class="client">maroon</span> ones are known as <em>client-side</em> languages. <br>
        They are interpretted by the web browser like chrome or firefux. <br>
        The <span class="server">blue</span> ones are called <em>server-side</em> languages. <br>
        Their functionality depends on little Chinese children in my basement. <br>
        Git is a Version Control System built into your computer if you have a mac. <br>
      </p>
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
    <section class="scope">
      <p>
        Now, probably you are thinking: why tf would I want to waste sexy yoga time to type on my computer machine?
        This I also asked at first. But, regard me please. The coding is very <strong>powerful</strong>. <br>
        We can be making:
      </p>
      <ul>
        <li>Dynamic Websites</li>
        <li>Webapps</li>
        <li>Databases Driven Thingys</li>
      </ul>
      <p>When we conquer this terrain we may tackle:</p>
      <ul>
        <li>Swift Apps for iOS</li>
        <li>JAVA Apps for Android losers</li>
        <li>Artificially intelligent Python Programs</li>
      </ul>
    </section>
    <section class="start">
      So. Where to start? Regard me please. It is very imprtant that you learn the Git, CSS and HTML first. <br>
      You can be learning the HTML in 15 minutes. CSS will take 17. Git is a little trickier. <br>
      In theory you should be doing the Git first. But if you want to flex your sexy muscles, do the HTML and CSS first. <br>
      Try clicking on some of the links up above to see where I reccomend you start being the learning. <br>
      When you get the hang of those three, come back and try to make this page better (impossible). <br><br>
      If you like this page and you are interested in participating, please click <a href="images/oops.jpg">here</a>.
    </section>
    <section class="cost">
      <h2>Cost</h2>
      <p>
        So my friends. Now you are probably thinking that this is too good to be true.<br>
        Not so! Only, these <strong>powerful</strong> resources are not completely free. <br>
        The capitalist pigs at Amazon intend to charge us for our databases and instances. <br>
        The nerds at codecademy also try to trick you into paying for a pro membership by means of their free trial. <br>
        My friends, regard me. It is of the utmost importance that you do not forget to cancel this trial. <br>
        Given that you cancel this trial in time, our costs should come to no more than about 5 dollars per month. <br>
        Now I understand that for some of us, this price may be a bit steep. But if we can get our fellow spirits to commit, we can all afford to <strong>boom</strong>.
      </p>
    </section>
    <section>
      <h2>Join Me! Yes!</h2>
      <p>Do not hesitate friends! Put your name in this box and let us embark. Your muscles remember. Yes!</p>
      <form class="join" action="index.php" method="post">
        <input type="text" name="name" value="name">
        <input type="submit" name="join" value="Boom" onclick="alert('Encouragement! Yes!')">
      </form>

      <!-- add PHP to add member to appropriate table -->
      <?php
        if(isset($_POST['name'])){
          $name = "'" . $_POST['name'] . "'";
          //echo $name;
          $sql = "INSERT INTO participants
                  VALUES ($name);";
          //echo $sql;
          $statement = $pdo->prepare($sql);
          $statement->execute();
          $statement->closeCursor();
        }
        $sql = 'SELECT * FROM participants';
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $members = $statement->fetchAll();
        $statement->closeCursor();
        ?>

        <h3>Confirmed Peacocks</h3>
        <ol>


        <?php
        foreach ($members as $member):
          echo "<li>" . $member['name'] . "</li>";
        endforeach;
        ?>
        </ol>
    </section>
  </body>
</html>
