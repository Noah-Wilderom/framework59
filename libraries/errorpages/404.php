<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Error</title>
    <style>
        body {
            text-align: center;
            line-height: 10px;
        }
        p {
            font-size: 20px;
            padding-bottom: 50px;
        }

        code {
            background-color: lightgrey;
            border-radius: 5px;
            padding: 5px;
            color: red;
            line-height: 35px;
        }
    </style>
</head>
<body>
    <h1>404 Error</h1>
    <p>Page has not been found!</p>
    <?php if(config['DEBUG_MODE']) { ?>
    <code>
        <?php 
        foreach($errors as $error) {
            echo $error;
            echo "<br>";
        }
        ?>
    </code>
    <?php } ?>
</body>
</html>