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
      //echo "<p>You are connected to the $which_db database named $dbname.</p>";
    } catch (PDOException $e){
      $error_message = $e->getMessage();
      //echo "<p>An error occurred while connecting to the $which_db database: $error_message </p>";
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
      //echo $sql;
      $statement = $pdo->prepare($sql);
      $statement->execute();
      $statement->closeCursor();
    }
    foreach($skills as $id => $skill){
      $sql= "UPDATE homework
              SET skill = ('$skill')
              WHERE id = $id;";
      //echo $sql;
      $statement = $pdo->prepare($sql);
      $statement->execute();
      $statement->closeCursor();
    }

    //check if someone has accepted challenge and add them to the table
    if(isset($_POST['challenger'])){
      $name = $_POST['challenger'];
      $id = $_POST['challenge_id'];

      $sql = "UPDATE homework
      SET name = ('$name')
      WHERE id = $id;";

      $statement = $pdo->prepare($sql);
      $statement->execute();
      $statement->closeCursor();
    }
    ?>
    <section id="welcome">
      <h1>BRAVE PEACOCKS</h1>
      <h2>I return.</h2>
      <p>
        Regard me. There was a powerful disturbance in the cosmic karma. <br>
        For two weeks Salvadore survived on only sexy yoga and flaming hot cheetos. <br>
        But no more is it the time for hiding! <strong>Boom.</strong> Regard me please. <strong>Boom.</strong> <br>
        Now is the time for coding. <br>
       </p>
        <!-- <img src="images/salvadore.jpg" alt="master of sexy yoga and LAMP Stack expert"> -->
       <p>
         Now that you have all flexed your sexy muscles by completing all the git, HTML, and CSS courses that I suggested...  <br>
         <em>We are ready to train!</em> Regard me please. I have provided 6 challenges for you to choose from. <br>
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
        Regard me. Please type your name below the challenge you wish to tackle then click <strong>Accept</strong>. <br>
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
        echo "<strong>" . $i . ".</strong> " . $assignment['task'] . ". <br> Skill: " . $assignment['skill'] . "<br>";
        //add an option to accept this challenge if it is not taken. If it is taken, echo the challenger's name.
        if(isset($assignment['name'])){
          echo "Brave peacock <strong>" . $assignment['name'] . "</strong> has accepted this challenge.<br><br>";
        }
        else{
          //add html form to input name
          ?>
            <form class="accept_task" action="index.php" method="post">
              <input type="text" name="challenger" value="name">
              <input type="hidden" name="challenge_id" value="<?php echo $assignment['id']; ?>">
              <input type="submit" name="submit_challenge" value="Accept" onclick="alert('Encouragement! Yes!')">
            </form>
            <br><br>
          <?php
        }
        $i++;
      };

       ?>
    </section>
    <section>
      <h1>COMPUTER MACHINE SETUP</h1>
      <p>
      Ok. Salvadore must make a quick confession. These assignments are really easy. <br>
      This, I have done for the true challenge is to prepare your computer machine to be <em>powerful</em> beast. <br>
      Do not be discouraged my friends! <br>
      For I will guide your body and your computer machine through these difficult positions like a sherpa. <br>
      And if your muscle memory needs a little more guiding, swing by my yurt with your computer machine and I will <strong>Boom</strong> this one for you. <br><br>
      Truly, there are <strong>3</strong> components to this process. <br>
      </p>
      <ol>
        <li>Download and install <a href="https://atom.io/" target="_blank">Atom</a> or the text editor of your choice</li>
        <li>Download, install and configure <a href="https://www.apachefriends.org/index.html" target="_blank">Xampp</a></li>
        <li>Setup git and github (again no relation to The Hub) to track your changes and share them with the peacock flock</li>
      </ol>
      <h2>Atom</h2>
      <p>
      There is nothing special about this step. <br>
      Simply visit <a href="https://atom.io/" target="_blank">Atom.io</a> and install this like you would install great game snake on your computer machine. <br>
      Now you can open Atom and explore. <br>
      This is where you will be typing your code. This is where I am typing these beautiful words right now. <br><br>
      </p>
      <h2>Xampp</h2>
      <p>
      Here is where we get a little funky my friends. <br>
      Begin by visiting <a href="https://www.apachefriends.org/index.html" target="_blank">www.apachefriends.org/index.html</a>. <br>
      <strong>Download and install</strong> the latest version. Just like you did for Atom only this site is not so pretty and there are more tricks to throw off your karma. <br>
      Believe in yourself, read the numbers carefully and pick the biggest number for the correct type of computer machine. <br><br>
      So far so good. <br><br>
      Now you can open the Xampp and connect with the energies of the program. <br>
      Click through some tabs and click all the buttons that have the good karmas: <strong>Start, Start All, Enable</strong>. <br>
      When you have weeded out these magic buttons and gotten lots of happy green lights, this means you have establish the contact with the Chinese children. <br><br>
      Very good! Encouragement! Yes! <br><br>
      Journey back to the <strong>General</strong> tab of the Xampp and click <strong>Go to Application</strong>. <br>
      Clearly this application is uninteresting compared to Salvadore's. <br>
      But we will be using the <strong>HOW-TO GUIDES</strong> located in the blue bar at the top. <br>
      When you have located this two paltry HOW-TO GUIDES, you will come to understand the true superiority of Salvadore's instruction. <br><br>
      Let us begin with the <strong>Enable Remote Access to phpMyAdmin</strong> "guide". <br><br>
      <h3>Enable Remote Access to phpMyAdmin</h3>
      Brave peacocks who have ventured this far, stay with me! <br><br>
      Regard me please. <strong>IF YOUR MUSCLE MEMORY IS PULSATING</strong>, go ahead and click <strong>Open Terminal</strong> on the <strong>General</strong> tab of Xampp to folow the <strong>Enable Remote Access to phpMyAdmin </strong> "guide" <br>
      You will be needing the <strong>nano</strong> command to edit the file. <br>
      If you try the nano command in the step below and it cannot be found, use the commands:<br><br>
      apt-get update <br>
      apt-get install nano <br><br>
      Now you may use the command: <br><br>
      nano /opt/lampp/etc/extra/httpd-xampp.conf <br><br>
      to edit this file within the terminal. <br>
      Control-O will save the file. <br><br>
      <strong>IF YOUR SPIRIT WAVERS</strong> you can simply do this from the Finder on Mac or in whatever the fuck the file thing is called on Windows. <br>
      <strong>Open Xampp</strong>. <br>
      Go to the <strong>Volumes</strong> tab. <br>
      Click <strong>Mount</strong> like Sully mounts dogs at the dog park. <br>
      Click <strong>Explore</strong>. <br>
      Navigate to the opt folder then proceed lampp->etc->extra. <br>
      Here you will find the httpd-xampp.conf file. <br>
      <strong>Right click</strong> on it to open it with <strong>Atom</strong>. <br>
      Make the edit described in the Enable Remote Access to phpMyAdmin guide and save the file. <br><br>
      <strong>WELL DONE MY FRIENDS! YES!</strong> <br><br>
      </p>
      <h3>Reset the MySQL/MariaDB Root Password</h3>
      <p>
      Regard me please! If you escaped using the <strong>terminal</strong> in the last step, you will not be so lucky again.<br>
      Do not be intimidated by this little bokis. It is basically the Finder for nerds. <br><br>
      Luckily the <strong>HOW-TO GUIDE</strong> provided by xampp here is actually somewhat in touch with the cosmic karmas. <br>
      To find it, click <strong>Go To Application</strong> in the <strong>General</strong> tab of the xampp machine. <br>
      In the blue bar, please be clicking <strong>HOW-TO GUIDES</strong>. <br>
      Click <strong>Reset the MySQL/MariaDB Root Password</strong>. <br><br>
      Very good! We are ready. <br><br>
      You can follow these instructions exactly if you are a nerd and read them carefully once before actually doing anything. <br>
      Otherwise, regard the Salvadore's instructions please: <br><br>
      <strong>Open Xampp</strong>.<br>
      Navigate to the <strong>General</strong> tab. <br>
      Click <strong>Open Terminal</strong>. <br>
      Do not fear this nerdy bokis. <br>
      Stick this command right into its nerdy <strong>Boom</strong> but wait to press enter: <br>
      <strong>/opt/lampp/bin/mysqladmin --user=root password "Salvadore12345"</strong> <br>
      If you would like your password to be Salvadore12345, <strong>Press Enter</strong>. <br>
      Otherwise, <strong>replace the text inside the quotations</strong> with your preferred password. <br><br>
      Encouragement my friend! <br><br>
      Your password is now changed. <br>
      To test this, run the following command:<br><br>
      <strong>/opt/lampp/bin/mysql --user=root --password=gue55me -e "SELECT 1+1"</strong><br><br>
      If the nerdy bokis responds with another even nerdier bokis that does some nerdy math, <em>congratulations!</em> It worked. <br><br>
      But you also just broke everything... <br><br>
      </p>
      <h3>We Can Fix It!</h3>
      <p>
      <strong>My friends!</strong> You hsve come so far and we are very close now. <br>
      Hopefully you have been enjoying some Justin Beebers on the Sputify while you have worked on this. <br>
      This is our <strong>final step</strong> to configure the Xampp. Encouragement! <br><br>
      Head to the <strong>General</strong> tab of <strong>Xampp</strong>. <br>
      Click <strong>Go To Application</strong>. <br>
      This time, in the blue bar, click <strong>phpMyAdmin</strong>. <br>
      You should see many red bokisis with very bad karmas. <br>
      We must realign thier energies. <br>
      Let us break open that nerdy bokis once more. <br><br>
      Return to the <strong>General</strong> tab of <strong>Xampp</strong>. <br>
      Click <strong>Open Terminal</strong>. <br>
      If you did not already make sure <strong>nano</strong> is installed, run:<br><br>
      apt-get update <br>
      apt-get install nano <br><br>
      Very Good! <br>
      Now we must edit a line of code in the <strong>config.inc.php</strong> file. <br>
      Use the nano command by running: <br><br>
      <strong>nano /opt/lampp/phpmyadmin/config.inc.php</strong><br><br>
      Use the down arrow key to scroll down a little until you see:<br><br>
      <strong>
      /* Authentication type */ <br>
      $cfg['Servers'][$i]['auth_type'] = 'config'; <br>
      $cfg['Servers'][$i]['user'] = 'root'; <br>
      $cfg['Servers'][$i]['password'] = '';<br>
      </strong><br><br>
      Type your password between the empty single quotation marks.<br><br>
      <strong>Boom. Yes. Boom.</strong> <br><br>
      I can feel the cosmic karma coming back into order. <br>
      To confirm that this is the case: <br><br>
      Head to the <strong>General</strong> tab of <strong>Xampp</strong>. <br>
      Click <strong>Go To Application</strong>. <br>
      In the blue bar, click <strong>phpMyAdmin</strong>. <br>
      Now, the angry red bokisis should have vanished. <br>
      Instead, your computer machine allows you access to this very <em>powerful</em> tool. <br>
      But now my peacocks. It is time to get access to the most powerful tool of all...<br><br>
      <strong>Salvadore's Code</strong><br><br>
      </p>
      <h2>Git and The Hub. I mean Github.</h2>
      <p>
      Here, we will prepare your computer machine to communicate with the rest of the flock. <br><br>
      My friends, go to <a href="https://github.com/" target="_blank">GitHub</a> and <strong>create an account</strong>. <br>
      When you are ready search for the repository <strong>"Sexy-Yoga"</strong> by SmeatsBeats (who tf is SmeatsBeats?) <br>
      Or just <a href="https://github.com/SmeatsBeats/Sexy-Yoga">Click Here</a>. <br>
      Take a moment to look around. <br>
      Find the green bokis that says <strong>Clone or download</strong>.<br>
      Click this bokis and <strong>copy the provided link</strong>. <br><br>
      Now we must prepare a folder on your computer machine to receive this incredible package of Salvadore's. <br><br>
      If you are sick of stupid nerdy bokis terminal, just <strong>use the finder</strong> for now. <br>
      <strong>Create a folder</strong> somewhere, maybe documents, where you will be doing the coding. <br>
      Okay. Now you have to open the nerdy bokis. <br>
      But this time, we are using the <strong>terminal on your computer machine. NOT the terminal on the Xampp machine.</strong> <br>
      To open nerdy bokis on Mac, <strong>press command-spacebar</strong> and then <strong>search: terminal</strong>. <br>
      Press enter. <br>
      In the terminal, type: <br><br>
      <strong>ls</strong><br><br>
      This will list the files and folders contained in your current directory and give you an idea of where tf you are. <br>
      Use the <strong>cd</strong> command to navigate into the folder you created. <br>
      For instance, if you made a folder called <strong>code</strong> within your <strong>Documents</strong> folder type: <br><br>
      <strong>cd Documents</strong><br><br>
      To move into your Documents folder <strong>IF</strong> your documents folder appeared when you ran the <strong>ls</strong> command. <br>
      If the Documents folder did not appear when you ran the <strong>ls</strong> command, you will need to use <strong>cd</strong> to naviagte into the folder that <em>does</em> contain your Documents folder. <br>
      Now that you are in the Documents folder, use <strong>cd</strong> again to enter the <strong>code</strong> folder:<br><br>
      <strong>cd code</strong> <br><br>
      We will turn this directory into a <em>repo</em>. <br>
      Which just tells the little Chinese kids to pay attention to all the changes we make here. <br>
      Run the command: <br><br>
      <strong>git init</strong><br><br>
      <strong>Boom</strong>. Now this folder is a git repo. <br>
      Now me must connect to the github. <br>
      Run the commands: <br><br>
      <strong>git clone https://github.com/SmeatsBeats/Sexy-Yoga.git</strong> <br><br>
      <!-- <strong>git remote add origin https://github.com/SmeatsBeats/Sexy-Yoga.git</strong><br><br> -->
      This link is the one you copied from the green bokis on github.com. Feel free to just copy the whole line from here. <br>
      Now your code folder should contain a folder called <strong>Sexy-Yoga</strong> which in turn contains all the files thta make up this project!<br>
      <strong>Fantastic my brave peacocks!</strong>. Your computer machine is now ready.
      </p>
      <h2>Using Your Computer Machine</h2>
      <p>
      Now you may be thinking, wtf do I do with all this shit?<br>
      You will be doing the coding of course! <br>
      Try opening the <strong>index.php</strong> file from the <strong>Sexy-Yoga</strong> folder in <strong>Atom</strong>.<br>
      Scroll way down until you see <strong>This Very Sentence</strong>.<br>
      Try changing some of the words! Save the file. <br>
      Your changes will be <strong>local</strong> and therefore invisible on the live site. <br>
      But to make them official on your machine, <strong>copy</strong> the <strong>Sexy-Yoga</strong> folder from your <strong>Documents/code</strong> folder.<br>
      Now <strong>open Xampp</strong>.
      Head to the <strong>Volumes</strong> tab and click <strong>Mount</strong> then <strong>Explore</strong>. <br>
      <strong>Paste</strong> the <strong>Sexy-Yoga</strong> folder into the <strong>htdocs</strong> folder. <br>
      You will need to re-paste this Sexy-Yog filder into the htdocs folder each time you wish to see your changes.<br>
      Head to the <strong>General</strong> tab of Xampp and click <strong>Go to Application</strong>.<br>
      In the URL of your browser, <strong>replace</strong> the word <strong>dashboard</strong> with the folder name, <strong>Sexy-Yoga</strong>. <br>
      <strong>Refresh the page</strong>. <br>
      Your changes should be visible! <br><br>
      Again this is only so on your very own computer machine. To share these changes with the flock, you must <strong>Push</strong> them to Github. <br><br>
      To do this, use the command: <br><br>
      <strong>git push origin <em>branch</em></strong><br>
      You must replace <em>branch</em> with the name of your very own branch. <br>
      I have created these for each of you:<br>
      </p>
      <ul>
        <li>Your-Mama</li>
        <li>Swag-Money-Bitch</li>
        <li>Ryan-Slvadore-Kraus</li>
        <li>Old-Gregory</li>
        <li>Kristen-Boom-Bollinger</li>
        <li>Yeehaw</li>
      </ul>
      <br><br>
      Oh yes. Whoever does not complete their assignment by <strong>Midnight, March 16th</strong> will be destroyed.<br><br>
      Happy coding my brave peacocks!!
    </section>
  </body>
</html>
