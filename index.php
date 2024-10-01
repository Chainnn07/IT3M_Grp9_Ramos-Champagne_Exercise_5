<?php
session_start(); 

$hostname = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "dbg9"; 

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$uname = "";
$psw = "";
$show_edit_button = FALSE;
$keep_modal_open = FALSE;

$new_Username = "";
$new_Password = "";
$ID;

$Champagne_show_edit_button = FALSE;
$Fiona_show_edit_button = FALSE;
$Zaira_show_edit_button = FALSE;
$Perales_show_edit_button = FALSE;
$Pante_show_edit_button = FALSE;

$desc = "Hello! I am Champagne C. Ramos, 20 years old, living in the Philippines. Currently studying Bachelor of Science in Information Technology at Pamantasan ng Lungsod ng Muntinlupa. I am passionate about technology and always strive to learn more about it. I am eager to collaborate with other team members to achieve our common goal.";
$desc2 = "Hello, my name is Fiona Jade D. Soriaga, 19 years old. I am an I.T student studying in Pamantasan ng Lungsod ng Muntinlupa. My coursework has equipped me with a strong foundation in front-end development and graphic design. I hope to learn more and gain experience from future projects with my team.";
$desc5 = "Hi, I am Zaira Yvonne V. Yagaya and I'm currently a 3rd Year College Student at Pamantasan ng Lungsod ng Muntinlupa taking the degree of Bachelor in Science and Information Technology. I'm not that knowledgeable when it comes to the course I've taken, so I'm exploring my options since being an IT student is flexible in jobs it might offer in the future.";
$desc6 = "Hello! I am Jhonhuvert Perales, a 20-year-old IT student with a passion for technology and innovation. I am currently pursuing a degree in Information Technology focused on gaining practical experience and knowledge to prepare for a successful career in the tech industry. My interests include coding, cybersecurity, and exploring the latest trends in technology.";
$desc4 = "Hi! I'm John Carlo Pante";


// Function to sanitize user input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Logging in
if (isset($_POST['lgbt'])) {
    $uname = test_input($_POST["uname"]);
    $psw = test_input($_POST["psw"]);

    $query = "SELECT ID FROM accounts WHERE Username='$uname' AND Password='$psw'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['loggedin_user'] = $uname;
        $error_message = "";

        // Fetch the user's ID
        $row = mysqli_fetch_assoc($result);
        $ID = $row['ID'];

        // Set button visibility based on user ID
        switch ($ID) {
            case 0:
                $Champagne_show_edit_button = TRUE;
                break;
            case 1:
                $Fiona_show_edit_button = TRUE;
                break;
            case 2:
                $Zaira_show_edit_button = TRUE;
                break;
            case 3:
                $Perales_show_edit_button = TRUE;
                break;
            case 4:
                $Pante_show_edit_button = TRUE;
                break;
            default:
                $Champagne_show_edit_button = FALSE;
                $Fiona_show_edit_button = FALSE;
                $Zaira_show_edit_button = FALSE;
                $Perales_show_edit_button = FALSE;
                $Pante_show_edit_button = FALSE;
                break;
        }
    } else {
        $Champagne_show_edit_button = FALSE;
        $Fiona_show_edit_button = FALSE;
        $Zaira_show_edit_button = FALSE;
        $Perales_show_edit_button = FALSE;
        $Pante_show_edit_button = FALSE;
        $error_message = "Invalid username or password.";
        $keep_modal_open = TRUE;
        $uname = "";
    }
}
if (isset($_POST['Confirm'])) {
    $new_Username = test_input($_POST['New_Username']);
    $new_Password = test_input($_POST['New_Password']);
    $desc = test_input($_POST['description']); 

    if ($ID !== NULL) {
        // Prepare the statement
        $stmt = $conn->prepare("UPDATE accounts SET Username = ?, Password = ?, Description = ? WHERE ID = ?");
        $new_Password_hashed = password_hash($new_Password, PASSWORD_DEFAULT); // Hash the password
        $stmt->bind_param("sssi", $new_Username, $new_Password_hashed, $desc, $ID);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Record updated successfully";
            } else {
                echo "No changes made to the record.";
            }
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: No valid ID found for updating.";
    }
}

// Setting placeholder

$Username_Placeholder = $uname;
$Password_Placeholder = $password;
$Description_Placeholder = "";

    $query = "SELECT ID FROM Accounts WHERE Username='$uname' AND Password='$psw'";
    $result = mysqli_query($conn, $query);
    


if (mysqli_num_rows($result) > 0) {
    $_SESSION['loggedin_user'] = $uname;
    $error_message = "";

    // Fetch the user's ID
    $row = mysqli_fetch_assoc($result);
    $ID = $row['ID'];
    switch ($ID) {
        case 0:
            $Description_Placeholder = $desc;
            break;
        case 1:
            $Description_Placeholder = $desc2;
            break;
        case 2:
            $Description_Placeholder = $desc5;
            break;
        case 3:
            $Description_Placeholder = $desc6;
            break;
        case 4:
            $Description_Placeholder = $desc4;
            break;
        default:
            break;
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Group Nine</title> 
    <link rel="stylesheet" href = "style.css">
</head>
<body>


<div class="float-container">

    <div class="float-header">
    <div class="button-container">
    <!-- Login Button -->
        <h4 class="loginbot">
            <a onclick="document.getElementById('id01').style.display='inline-block'" style="width:auto; display:inline-block; margin-right: 15px;" name="Login">Login</a>
        </h4>
    
        <!-- Services Button -->
        <h4 class="servicesbot">
            <a href="services.php" style="width:auto; display:inline-block;" name="Services">Services</a>
        </h4>
    </div>

        <h5>
            <?php
            echo "<p>Currently Logged On:</p>";
            echo $uname;
            ?>
        </h5>

        <?php
        echo "<h2>About Us</h2>";
        echo "<p>Integrative Programming & Technologies | Group 9 | IT3M</p>";
        ?>
        
        <br>
    </div>
</div>


    <section id="Members">

<?php
$name = "Pante, John Carlo";
$title = "Member";
$email = "pantejohncarlo_bsit@plmun.edu.ph";
$image = "Pante.jpg"; 
$memberPageLink = "#M3"; 
?>
<div class="row">
<div class="column">
    <div class="card">
        <img src="<?php echo $image; ?>" style="width:100%">
        <div class="container">
            <h3><?php echo $name; ?></h3> 
            <p class="title"><?php echo $title; ?></p> 
            <p class="email"><?php echo $email; ?></p> 
            <p>
                <button class="button" onclick="window.location.href='<?php echo $memberPageLink; ?>'">Member Page</button>
            </p>
        </div>
    </div>
</div>

<?php
$name = "Perales, Jhonhuvert";
$title = "Member";
$email = "peralesjhonhuvert_bsit@plmun.edu.ph";
$image = "Perales.jpg"; 
$memberPageLink = "#M5"; 
?>

<div class="column">
    <div class="card">
        <img src="<?php echo $image; ?>" style="width:100%">
        <div class="container">
            <h3><?php echo $name; ?></h3> 
            <p class="title"><?php echo $title; ?></p> 
            <p class="email"><?php echo $email; ?></p> 
            <p>
                <button class="button" onclick="window.location.href='<?php echo $memberPageLink; ?>'">Member Page</button>
            </p>
        </div>
    </div>
</div>

<?php
$name = "Yagaya, Zaira Yvonne";
$title = "Member";
$email = "yagayazairayvonne_bsit@plmun.edu.ph";
$image = "Yagaya.jpg"; 
$memberPageLink = "#M4"; 
?>

<div class="column">
    <div class="card">
        <img src="<?php echo $image; ?>" style="width:100%"> 
        <div class="container">
            <h3><?php echo $name; ?></h3> 
            <p class="title"><?php echo $title; ?></p> 
            <p class="email"><?php echo $email; ?></p> 
            <p>
                <button class="button" onclick="window.location.href='<?php echo $memberPageLink; ?>'">Member Page</button>
            </p>
        </div>
    </div>
</div>

<?php
$name = "Soriaga, Fiona Jade";
$title = "Assistant Leader";
$email = "soriagafionajade_bsit@plmun.edu.ph";
$image = "Soriaga.jpg"; 
$memberPageLink = "#M2"; 
?>

<div class="column">
    <div class="card">
        <img src="<?php echo $image; ?>" style="width:100%">
        <div class="container">
            <h3><?php echo $name; ?></h3> 
            <p class="title"><?php echo $title; ?></p> 
            <p class="email"><?php echo $email; ?></p> 
            <p>
                <button class="button" onclick="window.location.href='<?php echo $memberPageLink; ?>'">Member Page</button>
            </p>
        </div>
    </div>
</div>

<?php
$name = "Ramos, Champagne";
$title = "Team Leader";
$email = "ramoschampagne_bsit@plmun.edu.ph";
$image = "Champagne.jpg"; 
$memberPageLink = "#M1"; 
?>

    <div class="column">
        <div class="card">
            <img src="<?php echo $image; ?>" style="width:100%">
            <div class="container">
                <h3><?php echo $name; ?></h3> 
                <p class="title"><?php echo $title; ?></p> 
                <p class="email"><?php echo $email; ?></p> 
                <p>
                    <button class="button" onclick="window.location.href='<?php echo $memberPageLink; ?>'">Member Page</button>
                </p>
            </div>
        </div>
    </div>
</div>

    </section>
    
    <?php
$member_name = "Ramos, Champagne";
$title = "Team Leader";
$desc = "Hello! I am Champagne C. Ramos, 20 years old, living in the Philippines. Currently studying Bachelor of Science in Information Technology at Pamantasan ng Lungsod ng Muntinlupa. I am passionate about technology and always strive to learn more about it. I am eager to collaborate with other team members to achieve our common goal.";
$githublogo = "github.png";
$linkedinlogo = "linkedin.png";
$courseralogo = "learning.png";
?>

<?php
$member_name = "Ramos, Champagne";
$title = "Team Leader";
$desc = "Hello! I am Champagne C. Ramos, 20 years old, living in the Philippines. Currently studying Bachelor of Science in Information Technology at Pamantasan ng Lungsod ng Muntinlupa. I am passionate about technology and always strive to learn more about it. I am eager to collaborate with other team members to achieve our common goal.";
$github_url = "https://github.com/Chainnn07";
$linkedin_url = "http://www.linkedin.com/in/champagne-ramos-097941322";
$coursera_url = "https://www.coursera.org/learner/champagne-ramos-3287";
?>

    <div class="member-card">
        <div class="member-one" id="M1">
            <div class="members">
                <div class="tcard">
                    <img src="Champagne.jpg" class="pfp2">
                    <?php
                        echo "<p>$member_name</p>";
                        echo "<p class='title'>$title</p>";
                        echo "<a href='$github_url'> <img src='github.png' class='social-media-icon'> </a>";
                        echo "<a href='$linkedin_url'> <img src='linkedin.png' class='social-media-icon'> </a>";
                        echo "<a href='$coursera_url'> <img src='learning.png' class='social-media-icon'> </a>";
                    ?>
                    <button class="button2" onclick="window.location.href='#Members'">Back to Top</button>
                </div>

                <div class="desc">
                    <?php echo "<p>$desc</p>"; ?>
                    <?php 
                    $Champagne_Edit;
                    if ($Champagne_show_edit_button == TRUE) {
                        $Champagne_Edit = "Edit";
                        echo '<h5 class = "editbot5" onclick="document.getElementById(\'id02\').style.display= \'block\'" style="width:auto;">Edit User</h5>';
                    } else if ($Champagne_show_edit_button == FALSE ) {
                        $Champagne_Edit = "";
                        echo  $Champagne_Edit;
                    }
                    ?>
                    
                </div>

                <div class="stats">
                    <?php
                        echo "<p>HTML <div class='Bar'> <div class='Ramos-HTML'></div>  </div></p>";
                        echo "<p>CSS  <div class='Bar'> <div class='Ramos-CSS'></div>   </div></p>";
                        echo "<p>PHP  <div class='Bar'> <div class='Ramos-PHP'></div>   </div></p>";
                        echo "<p>Java <div class='Bar'> <div class='Ramos-JAVA'></div>  </div></p>";
                        echo "<p>C#   <div class='Bar'> <div class='Ramos-CS'></div>   </div></p>";
                        echo "<p>C++  <div class='Bar'> <div class='Ramos-CPP'></div>   </div></p>";
                    ?>
                </div>
            </div>
        </div>
    </div>

                </div>
            </div>

            <?php
    $member_name2 = "Soriaga, Fiona Jade";
    $title2 = "Assistant Leader";
    $desc2 = "Hello, my name is Fiona Jade D. Soriaga, 19 years old. I am an I.T student studying in Pamantasan ng Lungsod ng Muntinlupa. My coursework has equipped me with a strong foundation in front-end development and graphic design. I hope to learn more and gain experience from future projects with my team.";
    $github_url2 = "https://github.com/CraigIsGay-alt";
    $linkedin_url2 = "https://www.linkedin.com/in/fiona-jade-soriaga-798138282/";
    $coursera_url2 = "https://www.coursera.org/user/c1942eb1ec4912bf826d59d7ef038c9a";
    ?>

    <div class="member-two" id="M2">
        <div class="members">
            <div class="tcard">
                <img src="Soriaga.jpg" class="pfp2">
                <?php
                    echo "<p>$member_name2</p>";
                    echo "<p class='title'>$title2</p>";
                    echo "<a href='$github_url2'> <img src='github.png' class='social-media-icon'> </a>";
                    echo "<a href='$linkedin_url2'> <img src='linkedin.png' class='social-media-icon'> </a>";
                    echo "<a href='$coursera_url2'> <img src='learning.png' class='social-media-icon'> </a>";
                ?>
                <button class="button2" onclick="window.location.href='#Members'">Back to Top</button>
            </div>

            <div class="desc">
                <?php echo "<p>$desc2</p>"; ?>
                <?php 
                    $Fiona_Edit;
                    if ($Fiona_show_edit_button == TRUE) {
                        $Fiona_Edit = "Edit";
                        echo '<h5 class = "editbot5" onclick="document.getElementById(\'id02\').style.display= \'block\'" style="width:auto;">Edit User</h5>';
                    } else if ($Fiona_show_edit_button == FALSE ) {
                        $Fiona_Edit = "";
                        echo  $Fiona_Edit;
                    }
                    ?>
            </div>

            <div class="stats">
                <?php
                    echo "<p>HTML <div class='Bar'> <div class='Soriaga-HTML'></div></div></p>";
                    echo "<p>CSS  <div class='Bar'> <div class='Soriaga-CSS'></div></div></p>";
                    echo "<p>PHP  <div class='Bar'> <div class='Soriaga-PHP'></div></div></p>";
                    echo "<p>Java <div class='Bar'> <div class='Soriaga-JAVA'></div></div></p>";
                    echo "<p>C#   <div class='Bar'> <div class='Soriaga-CS'></div></div></p>";
                    echo "<p>C++  <div class='Bar'> <div class='Soriaga-CPP'></div></div></p>";
                ?>
            </div>
        </div>
    </div>

    <?php
    $member_name4 = "Pante, John Carlo";
    $title4 = "Member";
    $desc4 = "Hi! I'm John Carlo Pante";
    $github_url4 = "https://github.com/JohnCarloPante";
    $linkedin_url4 = "https://www.linkedin.com/in/john-carlo-pante-189469276/";
    $coursera_url4 = "https://www.coursera.org/user/f80199f8ed4376490930e97fdae7c4b6";
    ?>

    <div class="member-three" id="M3">
        <div class="members">
            <div class="tcard">
                <img src="Pante.jpg" class="pfp2">
                <?php
                    echo "<p>$member_name4</p>";
                    echo "<p class='title'>$title4</p>";
                    echo "<a href='$github_url4'> <img src='github.png' class='social-media-icon'> </a>";
                    echo "<a href='$linkedin_url4'> <img src='linkedin.png' class='social-media-icon'> </a>";
                    echo "<a href='$coursera_url4'> <img src='learning.png' class='social-media-icon'> </a>";
                ?>
                <button class="button2" onclick="window.location.href='#Members'">Back to Top</button>
            </div>

            <div class="desc">
                <?php echo "<p>$desc4</p>"; ?>

                <?php 
                    $Pante_Edit;
                    if ($Pante_show_edit_button == TRUE) {
                        $Pante_Edit= "Edit";
                        echo '<h5 class = "editbot5" onclick="document.getElementById(\'id02\').style.display= \'block\'" style="width:auto;">Edit User</h5>';

                    } else if ($Pante_show_edit_button == FALSE ) {
                        $Pante_Edit = "";
                        echo  $Pante_Edit;
                    }
                    ?>
            </div>

            <div class="stats">
                <?php
                    echo "<p>HTML <div class='Bar'> <div class='Pante-HTML'></div></div></p>";
                    echo "<p>CSS  <div class='Bar'> <div class='Pante-CSS'></div></div></p>";
                    echo "<p>PHP  <div class='Bar'> <div class='Pante-PHP'></div></div></p>";
                    echo "<p>Java <div class='Bar'> <div class='Pante-JAVA'></div></div></p>";
                    echo "<p>C#   <div class='Bar'> <div class='Pante-CS'></div></div></p>";
                    echo "<p>C++  <div class='Bar'> <div class='Pante-CPP'></div></div></p>";
                ?>
            </div>
        </div>
    </div>
    <?php
    $member_name5 = "Yagaya, Zaira Yvonne";
    $title5 = "Member";
    $desc5 = "Hi, I am Zaira Yvonne V. Yagaya and I'm currently a 3rd Year College Student at Pamantasan ng Lungsod ng Muntinlupa taking the degree of Bachelor in Science and Information Technology. I'm not that knowledgeable when it comes to the course I've taken, so I'm exploring my options since being an IT student is flexible in jobs it might offer in the future.";
    $github_url5 = "https://github.com/Yagaya-ZairaYvonne";
    $linkedin_url5 = "https://www.linkedin.com/in/random-yagaya-691929322/";
    $coursera_url5 = "https://www.coursera.org/user/3bb04c36051da0c75b38a1edfc500fb7";
    ?>

    <div class="member-four" id="M4">
        <div class="members">
            <div class="tcard">
                <img src="Yagaya.jpg" class="pfp2">
                <?php
                    echo "<p>$member_name5</p>";
                    echo "<p class='title'>$title5</p>";
                    echo "<a href='$github_url5'> <img src='github.png' class='social-media-icon'> </a>";
                    echo "<a href='$linkedin_url5'> <img src='linkedin.png' class='social-media-icon'> </a>";
                    echo "<a href='$coursera_url5'> <img src='learning.png' class='social-media-icon'> </a>";
                ?>
                <button class="button2" onclick="window.location.href='#Members'">Back to Top</button>
            </div>

            <div class="desc">
                <?php echo "<p>$desc5</p>"; ?>
                <?php 
                    $Zaira_Edit;
                    if ($Zaira_show_edit_button == TRUE) {
                        $Zaira_Edit = "Edit";
                        echo '<h5 class = "editbot5" onclick="document.getElementById(\'id02\').style.display= \'block\'" style="width:auto;">Edit User</h5>';
                    } else if ($Zaira_show_edit_button == FALSE ) {
                        $Zaira_Edit = "";
                        echo  $Zaira_Edit;
                    }
                    ?>
            </div>

            <div class="stats">
                <?php
                    echo "<p>HTML <div class='Bar'> <div class='Yagaya-HTML'></div></div></p>";
                    echo "<p>CSS  <div class='Bar'> <div class='Yagaya-CSS'></div></div></p>";
                    echo "<p>PHP  <div class='Bar'> <div class='Yagaya-PHP'></div></div></p>";
                    echo "<p>Java <div class='Bar'> <div class='Yagaya-JAVA'></div></div></p>";
                    echo "<p>C#   <div class='Bar'> <div class='Yagaya-CS'></div></div></p>";
                    echo "<p>C++  <div class='Bar'> <div class='Yagaya-CPP'></div></div></p>";
                ?>
            </div>
        </div>
    </div>

    <?php
    $member_name6 = "Perales, Jhonhuvert";
    $title6 = "Member";
    $desc6 = "Hello! I am Jhonhuvert Perales, a 20-year-old IT student with a passion for technology and innovation. I am currently pursuing a degree in Information Technology focused on gaining practical experience and knowledge to prepare for a successful career in the tech industry. My interests include coding, cybersecurity, and exploring the latest trends in technology.";
    $github_url6 = "https://github.com/GioAyno";
    $linkedin_url6 = "https://www.linkedin.com/in/jhonhuvert-perales-622932322/";
    $coursera_url6 = "https://www.coursera.org/user/1599a8d14a5db444ed567a24fc4703f3";
    ?>

    <div class="member-five" id="M5">
        <div class="members">
            <div class="tcard">
                <img src="Perales.jpg" class="pfp2">
                <?php
                    echo "<p>$member_name6</p>";
                    echo "<p class='title'>$title6</p>";
                    echo "<a href='$github_url6'> <img src='github.png' class='social-media-icon'> </a>";
                    echo "<a href='$linkedin_url6'> <img src='linkedin.png' class='social-media-icon'> </a>";
                    echo "<a href='$coursera_url6'> <img src='learning.png' class='social-media-icon'> </a>";
                ?>
                <button class="button2" onclick="window.location.href='#Members'">Back to Top</button>
            </div>

            <div class="desc">
                <?php echo "<p>$desc6</p>"; ?>
                <?php 
                    $Perales_Edit;
                    if ($Perales_show_edit_button == TRUE) {
                        $Perales_Edit = "Edit";
                        echo '<h5 class = "editbot5" onclick="document.getElementById(\'id02\').style.display= \'block\'" style="width:auto;">Edit User</h5>';
                    } else if ($Perales_show_edit_button == FALSE ) {
                        $Perales_Edit = "";
                        echo  $Perales_Edit;
                    }
                    ?>
            </div>

            <div class="stats">
                <?php
                    echo "<p>HTML <div class='Bar'> <div class='Perales-HTML'></div></div></p>";
                    echo "<p>CSS  <div class='Bar'> <div class='Perales-CSS'></div></div></p>";
                    echo "<p>PHP  <div class='Bar'> <div class='Perales-PHP'></div></div></p>";
                    echo "<p>Java <div class='Bar'> <div class='Perales-JAVA'></div></div></p>";
                    echo "<p>C#   <div class='Bar'> <div class='Perales-CS'></div></div></p>";
                    echo "<p>C++  <div class='Bar'> <div class='Perales-CPP'></div></div></p>";
                ?>
            </div>
        </div>
    </div>



<?php
$action_url = htmlspecialchars($_SERVER["PHP_SELF"]);
$show_modal_1 = isset($keep_modal_open) && $keep_modal_open; // Logic for the first modal
$show_modal_2 = isset($edit_user) && $edit_user; // Assuming $edit_user determines if the second modal should show
?>

<!-- First Modal -->
<div id="id01" class="modal" <?php if ($show_modal_1) echo 'style="display:block;"'; ?>>
    <form class="modal-content animate" action="<?php echo $action_url; ?>" method="POST">
        <div class="imgbox">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="box">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required value="<?php echo htmlspecialchars($uname); ?>">
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <button type="submit" class="lgnbtn" name="lgbt">Login</button>
            <div class="box" style="background-color:white">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>
        </div>
        <?php if (!empty($error_message)): ?>
            <p style="color:red; text-align:center;"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </form>
</div>

<!-- Second Modal -->
<div id="id02" class="modal" <?php if ($show_modal_2) echo 'style="display:block;"'; ?>>
    <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="<?php echo $action_url; ?>" method="POST">
        <div class="container">
            <h1>Edit Users</h1>
            <hr>
            <label for="Username"><b>Username</b></label>
            <input type="text" placeholder="<?php echo htmlspecialchars($Username_Placeholder); ?>" name="email" required>
            <label for="New_Username"><b>New Username</b></label>
            <input type="text" placeholder="Edit Username" name="new_email" required>
            <label for="Password"><b>Password</b></label>
            <input type="password" name="psw" required>
            <label for="New_Password"><b>New Password</b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
            <label for="description"><b>Description</b></label>
            <textarea id="desc" rows="10" cols="150"><?php echo htmlspecialchars($Description_Placeholder); ?></textarea>
            <div class="clearfix">
                <button type="submit" class="signupbtn">Confirm</button>
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </div>
    </form>
</div>

<script>
    var modal1 = document.getElementById('id01');
    var modal2 = document.getElementById('id02');

    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
        }
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }
</script>
</body>

</html>