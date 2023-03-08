<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BlogPost</title>
    </head>
    <body>
        <form action="/blog.php" id="usrform" method="post">
            Name: <input type="text" name="uname">
            <br>
            <textarea rows="4" cols="50" name="comment" form="usrform">How do you feel....</textarea>
            <br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>

