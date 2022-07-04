<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 Error - Framework59</title>
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
            border-radius: 0 5px;
            padding: 5px;
            color: red;
            line-height: 26px;
        }
    </style>
</head>
<body>
    <h1>500 Error</h1>
    <p>Internal error occurred!</p>
    <?php if(config['DEBUG_MODE'] && count($errors) > 0) { ?>
        <div style="max-width: 50%; margin: auto;">
            <code>
                <?php 
                    foreach($errors as $error) {
                    echo "[Framework59] " . $error;
                    echo "<br>";
                    }
                ?>
            </code>
        </div>
    <?php } ?>
</body>
</html>