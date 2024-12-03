<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="style.css">
    <title>DB project</title>
</head>
<body>
    <!-- echo prints -->
    <?php 
    // a dollar sign is basically a php variable
    $name = 'James';
    $age = 35;
        echo "Hello world"; 
        echo "<h1> Some h1 text</h1>";
        echo "<p>His name is $name </p>";
        echo "<p>His age is $age </p>";
    //   Making the string upper or lower case:
    $phrase = 'This is I Name';
        echo strtolower($phrase);
    //   also strings are just arrays of characters
        echo "<br> $phrase[1]<br>";
    // increment and decrerment also like $num++ and $num+=5
    $num = 9;
    $num++;
    echo $num;
    // getting user input
    
    ?>
    <p>Outside the php, normal HTML</p>
</body>
</html>