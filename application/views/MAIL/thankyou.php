<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ABC APP</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>        
        <style>.error{color:red;}</style>
    </head>
    <body>
        <div class="container">
            <div class="row text-center">
                <div class="col-sm-6 col-sm-offset-3">
                    <?php if(isset($error_text)){?>
                    <br><br> <h2 style="color:#E74C3C"><?=$error_text?></h2>
                    <?php } if(isset($success_text)){?>
                    <br><br> <h2 style="color:#0fad00"><?=$success_text?></h2>
                    <?php } ?>
                    <p></p>
                    <p style="font-size:20px;color:#5C5C5C;"><?=$message?></p>
                </div>

            </div>
        </div>
    </body>
</html>
