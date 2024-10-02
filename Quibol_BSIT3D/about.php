<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td, tr{
            border: 1px solid;
            padding: 10px;
        }
        table{
            margin:auto;
            border: 3px solid;
            background-color: whitesmoke;
        }
        h2{
            text-align:center;
        }
        body{
            background-color: beige;
        }
        div{
            
        }
    </style>
</head>
<body>
    <div>
        <h2>Registration Information</h2>
        <table>
            <tr>
                <td>
                    <?php 
                        if(isset($_SESSION["name"])){
                            echo"Name: " . $_SESSION["name"];
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php 
                        if(isset($_SESSION["email"])){
                            echo"Email: " . $_SESSION["email"];
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php 
                        if(isset($_SESSION["url"])){
                            echo"Facebook URL: " . $_SESSION["url"];
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php 
                        if(isset($_SESSION["phoneNumber"])){
                            echo"Phone Number: " . $_SESSION["phoneNumber"];
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php 
                        if(isset($_SESSION["gender"])){
                            echo"Gender: " . $_SESSION["gender"];
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php 
                        if(isset($_SESSION["countries"])){
                            echo"Country: " . $_SESSION["countries"];
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php 
                        if(isset($_SESSION["skills"])){
                            echo "Skills: ";
                            foreach($_SESSION['skills'] as $skill)
                                echo "<li> $skill </li>";
                        }   
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                        if(isset($_SESSION['biography'])){ 
                            echo "Biography:<br> " . $_SESSION['biography'] ;
                        }
                    ?>
                </td>
            </tr>

        </table>
    </div>
</form>
</body>
</html>
