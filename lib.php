<?php
function head() {
?>
    <!DOCTYPE html>
    
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="css/common.css" />
        <link rel="stylesheet" href="css/jquery.bxslider.css" />
        <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="js/jquery.bxslider.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#gnb>li>a").on("mouseover focus", function () {
                    $("#gnb #sub:visible").slideUp("fast");
                    $(this).next().stop().slideDown("normal");
                });
    
                $("header").on("mouseleave blur", function () {
                    $("#gnb #sub:visible").slideUp("fast");
                });
    
                $('.bxslider').bxSlider({
                    mode: 'fade',
                    captions: true,
                    auto: true,
                    autoControls: true
                });
                $("#mp1").click(function(){
                    $("#product").load("martin1.html");
                });
                $("#mp2").click(function(){
                    $("#product").load("martin2.html");
                });
                $("#lp1").click(function(){
                    $("#product").load("larrivee1.html");
                });
                $("#lp2").click(function(){
                    $("#product").load("larrivee2.html");
                });
                $("#tp1").click(function(){
                    $("#product").load("taylor1.html");
                });
                $("#tp2").click(function(){
                    $("#product").load("taylor2.html");
                });
                //$("#add").click(function(){
                //    $("#product").load("add.php");
                //});
            });
        </script>
        <title>Tony Guitar</title>
    </head>
    <body>
        <div id="wrap" class="default_wrap">
            <div class="default_wrap">
                <div id="main_banner" class="default_wrap">
                    <ul class="bxslider">
                        <li><img src="images/martin.jpg" title="Martin" /></li>
                        <li><img src="images/taylor.jpg" title="Taylor" /></li>
                        <li><img src="images/larrivee.jpg" title="Larrivee" /></li>
                    </ul>
                </div> <!-- banner -->
                <header style="background-image: url('images/logo.JPG');">
                    <div id="login">
                        Sign in, Sign up
                    </div>
                    <div id="logobox">
						<h1>Tony Guitar</h1>
					</div>
                    <nav>
                        <ul id="gnb">
                            <li><a href="index.html">HOME</a></li>
                            <li>
                                <a href="#">BRAND</a>
                                <ul id="sub">
                                    <li><a id="mp1" href="#">MARTIN</a></li>
                                    <li><a id="lp1" href="#">LARRIVEE</a></li>
                                    <li><a id="tp1" href="#">TAYLOR</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">CONTACT</a></li>
                        </ul>
                    </nav>
                </header>
                <div id="body_wrap" class="default_wrap">
                    <br />
<?php
} // head()
function foot() {
?>
                    <div>
                        <ul id="menu">
                            <li><a id ="add" href="add.php">Add</a></li>
                        </ul>
                    </div>
                </div> <!-- default wrap -->
            </div> <!-- body wrap -->
            <footer>
            <footer>
                <br />
                <hr />
                <p>Copyright © Tony Guitar in INT322 2016. All Rights Reserved</p>
            </footer>            
        </div>
    </body>
    </html>
<?php
}

//declare variables
$itemNameErr = $descErr = $spCodeErr = $costErr = $priceErr = $onHandErr = $reorderPointErr = $backOrderErr = $deletedErr = "";
$itemName = $desc = $spCode = $cost = $price = $onHand = $reorderPoint = $backOrder = $deleted = "";

//validate data
$validate_data = function () use (&$itemName, &$desc, &$spCode, &$cost, &$price, &$onHand, &$reorderPoint, &$backOrder, &$deleted, &$itemNameErr, &$descErr, &$spCodeErr, &$costErr, &$priceErr, &$onHandErr, &$reorderPointErr, &$backOrderErr, &$deletedErr){
    $check = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["itemName"])) {
            $itemNameErr = "Itemname is required";
            $check = false;
        } else {
            $itemName = test_input($_POST["itemName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[A-Za-z0-9 ,'-:;]+$/",$itemName)) {
                $itemNameErr = "letters, spaces, colon, semi-colon, dash, comma, apostrophe and numeric character (0-9) only";
                $check = false;
            }
        }
        if (empty($_POST["desc"])) {
            $descErr = "Description is required";
            $check = false;
        } else {
            $desc = test_input($_POST["desc"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[\r\n|\n|\rA-Za-z0-9 \.,'-]+$/",$desc)) {
                $descErr = "letters, digits, periods, commas, apostrophes, dashes and spaces only";
                $check = false;
            }
        }
        if (empty($_POST["spCode"])) {
            $spCodeErr = "Suppliercode is required";
            $check = false;
        } else {
            $spCode = test_input($_POST["spCode"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[A-Za-z 0-9-]+$/",$spCode)) {
            $spCodeErr = "letters, spaces, numeric characters (0-9) and dashes only";
            $check = false;
            }
        }
        if (empty($_POST["cost"])) {
            $costErr = "Cost is required";
            $check = false;
        } else {
            $cost = test_input($_POST["cost"]);
            if (!preg_match("/^\d+\.\d{2}$/",$cost)) {
            $costErr = "one or more digits, then a period, then two digits";
            $check = false;
            }
        }
        if (empty($_POST["price"])) {
            $priceErr = "Price is required";
            $check = false;
        } else {
            $price = test_input($_POST["price"]);
            if (!preg_match("/^\d+\.\d{2}$/",$price)) {
            $priceErr = "one or more digits, then a period, then two digits";
            $check = false;
            }
        }
        if (empty($_POST["onHand"])) {
            $onHandErr = "OnHand is required";
            $check = false;
        } else {
            $onHand = test_input($_POST["onHand"]);
            if (!preg_match("/^\d+$/",$onHand)) {
            $onHandErr = "digits only";
            $check = false;
            }
        }
        if (empty($_POST["reorderPoint"])) {
            $reorderPointErr = "Reorderpoint is required";
            $check = false;
        } else {
            $reorderPoint = test_input($_POST["reorderPoint"]);
            if (!preg_match("/^\d+$/",$reorderPoint)) {
            $reorderPointErr = "digits only";
            $check = false;
            }
        }
    }
    return $check;
}; //end $validate_data (anonymous function)
    
//connect database
function connect_db() {
    $lines = file("/home/int322_162b14/secret/topsecret.txt");
    $dbserver = trim($lines[0]);
    $uid = trim($lines[1]);
    $pw = trim($lines[2]);
    $dbname = trim($lines[3]);
    //Connect to the mysql server and get back our link_identifier
    $link = new mysqli($dbserver, $uid, $pw, $dbname)
            or die('Could not connect: '.$link->connect_error);
    return $link;
} //end connect_db()

//choose sql
$choose_sql = function () use (&$itemName, &$desc, &$spCode, &$cost, &$price, &$onHand, &$reorderPoint, &$backOrder){
    if (preg_match("/add\.php$/",$_SERVER["PHP_SELF"])) {
        $sql = "insert into inventory (itemName, description, supplierCode, cost, price, onHand, reorderPoint, backOrder, deleted)";
        $sql .= " values (";
        $sql .= "'".$itemName."'".", ";
        $sql .= "'".$desc."'".", ";
        $sql .= "'".$spCode."'".", ";
        $sql .= $cost.", ";
        $sql .= $price.", ";
        $sql .= $onHand.", ";
        $sql .= $reorderPoint	.", ";
        $sql .= "'".((isset($_POST['backOrder'])) ? 'y' : 'n')."'".", ";
        $sql .= "'n');";
    } else if (preg_match("/main\.php$/",$_SERVER["PHP_SELF"])) {
        $sql = "SELECT * FROM inventory;";
    } else {
        $count = $_GET['id'];
        if ($_GET['delete'] == 'y') {
            $sql = "update inventory set deleted='n' where id = $count;";	
        } else {
            $sql = "update inventory set deleted='y' where id = $count;";
        }
    }
    return $sql;
}; //end $choose_sql (anonymous function)

//print result
function select_sql($result){
    echo "<div id='product' class='default_wrap'>";
    echo "<table>";
    echo "<tr><td>ID</td><td>Item Name</td><td>Description</td><td>Supplier</td><td>Cost</td><td>Price</td><td>Number On Hand</td><td>Reorder Level</td><td>On Back Order?</td><td>Delete/Restore</td></tr>";
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>"."<td>".$row["itemName"]."</td>"."<td class='form_desc'>".$row["description"]."</td>"."<td>".$row["supplierCode"]."</td>"."<td>".$row["cost"]."</td>"."<td>".$row["price"]."</td>"."<td>".$row["onHand"]."</td>"."<td>".$row["reorderPoint"]."</td>"."<td>".$row["backOrder"]."</td>";
            echo "<td><a class=deleted href=delete.php?delete=".$row["deleted"]."&id=".$row["id"].">";
            if ($row["deleted"] == 'n')
                print 'Delete';
            else
                print 'Restore';
            echo "</a></td></tr>";
        }
    } else {
        echo "</table>";
        echo "0 results";
    }
    echo "</table>";
    echo "</div>";
} // end select_sql()

//make clean values for security
function test_input($data) { // making simple data
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} // end test_input()
?>