<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/practice.css">
    <title>Weenie Hut Haqs</title>
  </head>
  <body>
    <!-- connect to AWS RDS db -->
    <?php
      $dbhost = $_SERVER['practice.crac6blasqqn.us-east-1.rds.amazonaws.com'];
      $dbport = $_SERVER['3306'];
      $dbname = $_SERVER['practice-db'];
      $charset = 'utf8' ;

      $dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
      $username = $_SERVER['admin'];
      $password = $_SERVER['&iaTRSb#'];
      try{
        $pdo = new PDO($dsn, $username, $password);
        echo "<p>You are connected to the database.</p>";
      } catch (PDOException $e){
        $error_message = $e->getMessage();
        echo "<p>An error occurred while connecting to the database: $error_message </p>"
      }
    ?>
    <img src="images/weenie_hut_juniors.webp" alt="best restaurant ever">
    <section id="welcome">
      <h1><?php echo "Howdy." ?></h1>
      <h2>Welcome to Weenie Hut Junior's. Have a hot dog.</h2>
      <p>
        If you are on this amazing webpage, then you have expressed interest in coding at some point in time. <br>
        In case this website has not already convinced you of my prowess, I will simply confirm, I am a coding Jedi. <br>
        Still not convinced? Watch this. <strong>Boom.</strong> Regard me please. <strong>Boom.</strong> <br>
        That's right. It is I, Salvadore. <br>
       </p>
         <img src="images/salvadore.jpg" alt="master of sexy yoga and LAMP Stack expert">
       <p>
         Just because I tech sexy yoga you don't think I am capable of the coding? <br>
         <em>Fuck you.</em> Regard me please. Coding is basically sexy yoga for your computer machine. <br>
         And I am going to provide this safe space for all of us to practice, learn, grow and <strong>Boom</strong> together. <br>
      </p>
    </section>
    <section class="languages">
      <h2>Languages</h2>
      <p>
        The world of code can be overwhelming. Just like sexy yoga, the key is to breathe, and focus. <br>
        We will be focusing primarily on:
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
      <p>Before we get dive in, we will need some tools to assist us on our journey.</p>
      <ul>
        <li>A computer machine.</li>
        <li><a href="https://atom.io/" target="_blank">A Text Editor</a> - to type our code in.</li>
        <li><a href="https://www.apachefriends.org/index.html" target="_blank">Xampp</a> - to communicate with the Chinese children.</li>
        <li><a href="https://classroom.udacity.com/courses/ud206" target="_blank">Access to your command line</a> - to feel like a legit hacker and use git.</li>
        <li><a href="https://github.com/" target="_blank">A Github account</a> - no relation to "the Hub" hub.</li>
      </ul>
      <p>There are a few other components to this setup that will make you want to quit before you start:</p>
      <ul>
        <li>AWS Elastic Beanstalk</li>
        <li>Ngrok</li>
      </ul>
      <p>Best option might be to bring me your computer machine and I walk through it with you:</p>
      <img src="images/boom.jpg" alt="boom">
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
    </section
  </body>
</html>
