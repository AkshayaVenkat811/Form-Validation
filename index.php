<html>
    
<?php

    require 'studyDatabase.php';

    $mess = ' ';

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['comment']) && isset($_POST['gender']) )
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $comment = $_POST['comment'];
        $gender = $_POST['gender'];

        $pdoQuery = 'INSERT INTO people ( name, email, mobile, comment, gender) VALUES (:name, :email, :mobile, :comment, :gender)';
        
        $pdoResult = $database->prepare($pdoQuery);

        $pdofinal = $pdoResult->execute([':name'=>$name, ':email'=>$email,':mobile'=>$mobile, ':comment'=>$comment, ':gender'=>$gender]);

        if($pdofinal)
        {
           $mess = 'Data inserted successfully';
        }

    }

?>


<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    


    <style>
    .error {color: #FF0000;}
    body
    {
        background: lightblue;
    }
    form
    {
        margin-left: 100px;
    }

    *{
        box-sizing: border-box;
     }

    .container 
    {
        border-radius: 5px;
        
        padding: 20px;
    }

    input[type=text], textarea 
    {
        width: 50%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }
    label {
        padding: 10px 10px 10px 0;
        display: inline-block;
        }

        input[type=submit]
        {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover 
        {
             background-color: #45a049;
        }

    .col-25 
    {
        float: left;
        width: 15%;
        margin-top: 6px;
    }

    .col-50 
    {
        float: left;
        width: 100%;
        margin-top: 6px;
        margin-left: 100px;

    }
    .col-60 
    {
        float: left;
        width: 1o0%;
        margin-top: 6px;
        margin-left: 100px;
       

    }

    .col-75 
    {
        float: left;
        width: 85%;
        margin-top: 6px;
    }

    @media screen and (max-width: 600px)
    {
        .col-25,.col-75, input[type=submit] 
        {
        width: 100%;
        margin-top: 0;
       
        }
    }
    
    </style>
</head>

<body> 
        <div class="container">
            <?php

                $nameErr = $emailErr = $genderErr = $mobileErr = "";
                $name = $email = $gender = $comment = $mobile = "";


                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    if (empty($_POST["name"]))
                    {
                        $nameErr = "Name is required";
                    } 
                    else
                    {
                        $name = test_input($_POST["name"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z ]*$/",$name))
                        {
                            $nameErr = "Only letters and white space allowed";
                        }
                    }
                    
                    if (empty($_POST["email"])) {
                        $emailErr = "Email is required";
                    } else {
                        $email = test_input($_POST["email"]);
                    }
                        
                    if (empty($_POST["mobile"])) {
                        $mobile = "mobile is required";
                    } else {
                        $mobile = test_input($_POST["mobile"]);
                    }

                    if (empty($_POST["comment"])) {
                        $comment = "";
                    } else {
                        $comment = test_input($_POST["comment"]);
                    }

                    if (empty($_POST["gender"])) {
                        $genderErr = "";
                    } else {
                        $gender = test_input($_POST["gender"]);
                    }
                }

                function test_input($data)
                {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

            ?>

            <div class=row>
                <div class="col-50">
                    <h2> Form Validation </h2>
                    <p><span class="error">* required field</span></p>
                </div>
            </div>
                <div class="row"> 
                    <div class="col-60">
                        <?php if(!empty($mess)): ?>
                        <div class="alert alert-success">
                            <?= $mess;?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <form method= "post" >

            <div class="row">
                <div class="col-25">
                    <label for="name">Name</label>
                </div>
                <div class="col-75">
                    <input type="text"  name="name" id="name" placeholder="Your name..">
                    <span class="error">* <?php echo $nameErr;?></span>
                </div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="email"> E-mail</label>
                </div>
                <div class="col-75">
                    <input type="text"  name="email" id="email" placeholder="Your e-mail..">
                    <span class="error">* <?php echo $emailErr;?></span>
                </div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="mobile"> mobile</label>
                </div>
                <div class="col-75">
                    <input type="text" name="mobile" id="mobile" placeholder="Your mobile..">
                    <span class="error">* <?php echo $mobileErr;?></span>
                </div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="comment"> Comment</label>
                </div>
                <div class="col-75">
                    <textarea  name="comment" id="comment" placeholder="Write something.." style="height:200px";></textarea>
                    
                </div>
                <br><br>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="gender"> Gender</label>
                </div>
                <div class="col-75">
                    <input type="radio" name="gender" value="female" id="gender">Female
                    <input type="radio" name="gender" value="male" id="gender" >Male
                    <input type="radio" name="gender" value="other" id="gender" >Other
                    <span class="error"> <?php echo $genderErr;?></span>
                    
                </div>
                <br><br>
            </div>
            <div class="row">
                <input type="submit" value="Submit">
            </div>   
        
              

                <script type="text/javascript">

                $('#loginForm').submit(function() 
                {
                    if ($("#name").val() === "" || $("#email").val() === "" || $("#mobile").val() === "")
                    {
                    alert('Please enter Username, email and mobile .');
                    return false;
                    }
                });

                </script>
            </form>

            
        </div>

    </body>
</html>