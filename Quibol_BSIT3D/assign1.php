
<?php
    session_start();
        $uname = "";
        $uEmail = "";
        $uURL = "";
        $uPassword = "";
        $confirmPassword = "";
        $uphoneNumber = "";
        $uGender = "";
        $uCountry = "";
        $uskills = [];
        $uBiography = "";
        $error =[];

        function filter($input){
            $filtered = stripslashes(trim(htmlspecialchars($input)));
            return $filtered;
        }

        if(isset($_REQUEST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            $uname = filter($_REQUEST["name"]);
            $uEmail = filter($_REQUEST["email"]);
            $uURL = filter($_REQUEST['url']);
            $uPassword = filter($_REQUEST["password"]);
            $confirmPassword = filter($_REQUEST["conPassword"]);
            $uphoneNumber = filter($_REQUEST['phoneNumber']);
            $uGender = $_REQUEST["gender"] ?? null;
            $uCountry = $_REQUEST["countries"] ?? null;
            $uskills = $_REQUEST['skills'] ?? [];
            $uBiography = filter($_REQUEST['biography']) ?? null;

            //validate name
            if(empty($uname)){
                $error['name'] = "<t>enter a name";
            }
            elseif(isset($uname) && preg_match('/^[a-zA-Z\s]*$/', $uname)){ 
                $_SESSION['name'] = $uname;
            }
            else{
                $error['name'] = "invalid name";
            }


            //validatie email
            
            if(empty($uEmail)){
                $error['email'] = "enter an email";
            }
            elseif(filter_var($uEmail, FILTER_VALIDATE_EMAIL)){
                $_SESSION['email'] = $uEmail;
            }
            else{
                $error['email'] = "invalid email";
            }


            //validate url
            
            if(empty($uURL)){
                $error['url'] = "enter an url";
            }
            elseif($uURL == "fb.com" || $uURL == "facebook.com"){
                $_SESSION['url'] = $uURL;
            }
            else {
                $error['url'] = "incorrect url";
            }


            //validate password
            
            if(empty($uPassword)){
                $error['password'] = "enter your password";
            }
            elseif(strlen($uPassword) >= 8 && preg_match('/^(?=.*[A-Z])[A-Za-z0-9]+$/',$uPassword)){
                $_SESSION['password'] =$uPassword; 
                
                //validate confirm password
                if($uPassword == $confirmPassword){
                    $_SESSION['conPassword'] =  $confirmPassword;
                }
                else{
                    $error['conPassword'] = "wrong password";
                }
            }
            else{
                $error['password'] = "password must be: at least 8 characters, 1 uppercase and alphanumeric";
            }


           
            
            


            // validate phone number
            
            if(empty($uphoneNumber)){
                $error['phoneNumber'] = "enter phone number";
            }
            elseif(is_numeric($uphoneNumber) && strlen($uphoneNumber)==11 && preg_match('/^09.*$/',$uphoneNumber)){
                $_SESSION['phoneNumber'] = $uphoneNumber;
            }
            else{
                $error['phoneNumber'] = "<br>invalid phone number ex. 09231233421";
            }


            //validate gender
            
            if (isset($uGender)){
                $_SESSION['gender'] = $uGender;
            }
            else{
                $error['gender'] = "pick a gender";
            }

                                        
            //validate country
            
            if($uCountry == "default" || $uCountry == null){
                $error['countries'] = "pick a country";
            }
            else{
                $_SESSION['countries'] = $uCountry;
            }


            //validate checkbox
            
            if(empty($uskills)){
                $error['skills'] = "pick a skill";
            }
            else{
                $_SESSION['skills'] = $uskills;
            }

                                                
            //validate biography
            
            if(empty($uBiography)){
                $error['biography'] = "Enter biography";
            }
            elseif(strlen($uBiography) >= 200){
                $error['biography'] =  "input exceeds 200 characters";
            }
            else{
                $_SESSION['biography'] = $uBiography;
            }
            
            if(empty($error)){
                echo "<script>alert('Registration Complete');</script>";
            }
        }       
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td,tr{
            padding: 5px;
            border: 1px solid;
        }
        table{
            border:2px solid black;
            margin:auto;
        }
        div{
        }
        textarea{
            height: 100px;
        }
        h3{
            text-align:center;
        }
        .error{
            color: red;
            font-size: 12px;
            padding: 2px 5px;
        }
        .textbox{
            width: 320px;
        }
        .nontextbox{
            width:220px;
        }
        .seconButton{
            margin:auto;
        }
        .container {
            display:flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class = "container">
        <h3>Registration Form</h3>
        <table>
            <form id="registration" method="POST">
                <tr>
                    <td>
                        <div>
                            <label for="name">Name:</label><br>
                            <input type="text" name="name" id="name" class="textbox" value="<?php echo $uname;?>">
                        </div>   
                            <?php if(isset($error["name"])){
                                echo '<div class = "error">' .$error['name'] .'</div>';
                            }
                            ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="email">Email:</label><br>
                        <input type="text" name="email" id="email" class="textbox" value="<?php echo $uEmail;?>"> 
                        <?php if(isset($error["email"])){
                                echo '<div class = "error">' .$error['email'] .'</div>';
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="url">Facebook URL: </label><br>
                        <input type="text" name="url" id="url" class="textbox" value="<?php echo $uURL;?>">
                        <?php if(isset($error["url"])){
                                echo '<div class = "error">' .$error['url'] .'</div>';
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="password">Password: </label><br>
                        <input type="password" name="password" class="textbox" id="password" value="<?php echo $uPassword;?>">
                        <?php if(isset($error["password"])){
                                echo '<div class = "error">' .$error['password'] .'</div>';
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="conPassword">Confirm Password:</label><br>
                        <input type="password" name="conPassword" class="textbox" id="conPassword" value="<?php echo $confirmPassword;?>"> 
                        <?php if(isset($error["conPassword"])){
                                echo '<div class = "error">' .$error['conPassword'] .'</div>';
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="phoneNumber">Phone: </label><br>
                        <input type="text" name="phoneNumber" id="phoneNumber" class="textbox" value="<?php echo $uphoneNumber;?>"> 
                        <?php if(isset($error["phoneNumber"])){
                                echo '<div class = "error">' .$error['phoneNumber'] .'</div>';
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="nontextbox">
                            <label for="gender">Gender:</label>
                            <label> 
                                <input type="radio" name="gender" value="male" >
                                Male
                            </label>
                            <label> 
                                <input type="radio" name="gender" value="female">
                                Female
                            </label>
                        </div>
                        <?php if(isset($error["gender"])){
                                echo '<div class = "error">' .$error['gender'] .'</div>';
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="countries">Country</label>
                        <select name="countries" id="countries" value=$uCountry>
                            <option value="">choose</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Canada">Canada</option>
                            <option value="Japan">Japan</option>
                            <option value="China">China</option>
                            <option value="Russia">Russia</option>
                            <option value="New Zealand">New Zealand</option>
                        </select>
                        <?php if(isset($error["countries"])){
                                echo '<div class = "error">' .$error['countries'] .'</div>';
                            }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="skills">Skills: </label>
                        <label>
                            <input type="checkbox" name="skills[]" value="java">
                            Java
                        </label>
                        <label>
                            <input type="checkbox" name="skills[]" value="phyton">
                            Phyton
                        </label>
                        <label>
                            <input type="checkbox" name="skills[]" value="c++">
                            C++
                        </label>
                        <label>
                            <input type="checkbox" name="skills[]" value="javascript">
                            JavaScript
                        </label> 
                        <br>
                        <?php if(isset($error["skills"])){
                                echo '<div class = "error">' .$error['skills'] .'</div>';
                            }
                        ?>
                    </td>
                </tr>

                
                <tr>
                    <td>
                        <label for="biography" value="<?php echo $uBiography;?>">Biography:</label><br>
                        <textarea name="biography" id="biography" row="5" cols="39" placeholder="Enter biography...."></textarea>
                        <br>
                        <?php if(isset($error["biography"])){
                                echo '<div class = "error">' .$error['biography'] .'</div>';
                            }
                        ?>                 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" >
                        
                    </td>
                </tr>
            </form>
        
         
        </table>
        <DIV class="seconButton">
            <br>
            <form action="about.php" method="POST">
                <input type="submit" value="Go to info page">
            </form>
        </DIV>   
    </div>
    

</body>
</html>