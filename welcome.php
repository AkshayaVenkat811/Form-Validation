<html>
    <?php 

        require 'studyDatabase.php';

        $pdoQuery = 'SELECT * FROM people';
        $pdoResult = $database->prepare($pdoQuery);
        $pdoResult->execute();
        $people = $pdoResult->fetchALL(PDO::FETCH_OBJ);
    ?>



  <head>
    

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <style>
    
    body
    {
        background: lightblue;
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


    @media screen and (max-width: 600px)
    {
        .col-25, .col-75, input[type=submit] 
        {
        width: 100%;
        margin-top: 0;
        }
    }

    </style>

    </head>
    <body>
        <div class="container-fluid">
           

            <?php echo "<h2>Your Input:</h2>"; ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col" >
                        <table class="table table-bordered">
                        
                            <tr class="bg-info text-white">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Comment</th>
                                <th>Gender</th>

                            </tr>
                            <?php foreach($people as $person): ?>
                             <tr class="bg-light text-dark">
                                <td><?= $person->name; ?></td>
                                <td><?= $person->email; ?></td>
                                <td><?= $person->mobile; ?></td>
                                <td><?= $person->comment; ?></td>
                                <td><?= $person->gender; ?></td>
                            </tr> 
                            <?php endforeach; ?>

                        </table>
                        <div class="col" > </div>

                        <div class="col" > </div>

                        <div class="col" > </div>
                    </div>
                </div>
            </div>

            <form method="post" action="index.php">
            <input class="bg-success text-white" type="submit" name="submit" value="Back"> 
            </form>

        </div> 

    </body>
</html>