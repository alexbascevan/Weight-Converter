<?php
    /*-----------------------------
    Name: Alexander Bascevan
    Student ID: 991566471
    Course: SYST10199
    Date: March 22, 2023
    -----------------------------*/

    //dynamic html comment variables
    $name = "Alexander Bascevan";
    $id = "991566471";
    $fName = "Assignment3.php";
    $date = "March 22, 2023";

    //constants
    define("KG_POUND", 2.205);
    define("KG_OUNCE", 35.27);

    // variables for errors, output and the unit of measure
    $errors = "";
    $output = "";
    $unit = "";

    // variables for weight and number of packets
    $weightOfPacket = "";
    $numOfPackets = "";

    // take data from server and run validation
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //get weight and numOfPackets
        $weightOfPacket = $_POST["weightOfPacket"];
        $numOfPackets = $_POST["numOfPackets"];    

        //weight input validation
        if(!isset($weightOfPacket) || empty($weightOfPacket)){
            $errors .= "The weight field can not be empty<br>";
            $weightOfPacket = "";
        }elseif(!is_numeric($weightOfPacket)){
            $errors .= "The value of the weight field MUST be NUMERIC, You entered: $weightOfPacket<br>";
            $weightOfPacket = "";
        }elseif($weightOfPacket < 0){
            $errors .= "The value of the weight field MUST be POSITIVE, You entered: $weightOfPacket<br>";
            $weightOfPacket = "";
        }

        //num of packets input validation
        if(!isset($numOfPackets) || empty($numOfPackets)){
            $errors .= "The number of packets field can not be empty<br>";
            $numOfPackets = "";
        }elseif(!is_numeric($numOfPackets)){
            $errors .= "The value of the number of packets field MUST be NUMERIC, You entered: $numOfPackets<br>";
            $numOfPackets = "";
        }elseif($numOfPackets < 0){
            $errors .= "The value of the number of packets field MUST be POSITIVE, You entered: $numOfPackets<br>";
            $numOfPackets = "";
        }

        // get value of radio button and do calculations
            if(isset($_POST["unit"]) && $_POST["unit"] == "First"){
                $unit = "Lbs";
                if($errors == ""){
                    $output = KG_POUND * $weightOfPacket;
                    $output *= $numOfPackets;
                    number_format($output,2);
                }
            }elseif(isset($_POST["unit"]) && $_POST["unit"] == "Second"){
                $unit = "Oz";
                if($errors == ""){
                    $output = KG_OUNCE * $weightOfPacket;
                    $output *= $numOfPackets;
                    number_format($output,2);
                }
            }elseif(isset($_POST["unit"]) && $_POST["unit"] == "Third"){
                if($errors == ""){
                    $unit = "KG";
                    $output = $numOfPackets * $weightOfPacket;
                }
            }else{
                $errors .= "Please select a value for unit of weight<br>";
            }
        
        // if errors are present, append "Please Try Again" to end of error message
        if($errors != ""){
            $errors .= "Please Try Again";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web - Assignment 3</title>

    <style>

        /* top of page blurb styling */
        #blurb {
            font-size: 25px;
            color: black;
            font-weight: bold;
        }

        /* error text styling */
        #errorText {
            font-size: 20px;
            color: red;
        }

        /* text used in form labels styling */
        .form {
            font-size: 15px;
            color: black;
            font-weight: bold;
        }

        /* set html background color */
        body {
            background-color: #00FFFB;
        }

    </style>

</head>
<body>

<!-- Dynamic HTML Comments:
    Name: <?=$name;?>
    Student ID: <?=$id;?>
    File Name: <?=$fName;?>
    Date: <?=$date;?>
-->

<h1>Assignment 3</h1>
<hr>
<br>

<!-- blurb describing the program -->
<h1 id="blurb">
    This page calculates total weight of packets, given weight of
    one packets in kgs and number of packets and print the result in
    selected unit (Pounds, Ounces, Kilograms) in a new text box
</h1>


<!-- if any errors are present, display them here -->
<?php
    if($errors != ""){
       echo "<h3 id='errorText'>$errors</h3>";
    }
?>


<!-- form used for input -->
<form class="form" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
        <div>

            <!-- weight input -->
            <label for="id1">Weight of a packet in Kilograms:</label>
            <input type="text" name="weightOfPacket" id="id1" value="<?=$weightOfPacket;?>">

            <br><br>

            <!-- num of packets input -->
            <label for="id2">Total number of packets:&emsp;&emsp;&emsp;&ensp;</label>
            <input type="text" name="numOfPackets" id="id2" value="<?=$numOfPackets;?>">

            <br><br>

            <!-- radio buttons -->
            <label>Select the unit for total weight (Pounds, Ounces, Kilograms):</label>
            <br><br>
            <label for="id3">Pounds:</label>
            <input type="radio" name="unit" id="id3" value="First">
            <label for="id4">&emsp;Ounces:</label>
            <input type="radio" name="unit" id="id4" value="Second">
            <label for="id5">&emsp;Kilograms:</label>
            <input type="radio" name="unit" id="id5" value="Third"> 

            <br><br>
        </div>
        <div>
            <!-- submit button -->
            <input type="submit" value="Calculate and Convert">
        </div>

        <!-- Display output once there is output to display -->
        <?php
            if($output != ""){
                echo"   
                <div>
                    <br>
                    <label for='id6'>Total Converted Value in $unit is: </label>
                    <input type='text' name='output' id='id' value = '$output' disabled>
                </div>";
            }
        ?>
    </form>
 
</body>
</html>