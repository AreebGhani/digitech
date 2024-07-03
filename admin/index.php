<?php

include_once "./secure.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        const e = prompt("Enter Your Security Code");
        if (e == "<?php echo $key ?>") {
            sessionStorage.setItem("digitech", JSON.stringify("<?php echo $key ?>"));
            window.location.replace("./dashboard.html");
        } else {
            alert("Wrong Security Code . . .")
            window.location.replace("../");
        }
    </script>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>digitech &#8211; Login</title>
    <meta content="Digitech official website" name="description">
    <meta content="diigitech" name="keywords">
    <meta name="theme-color" content="#000000" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="../assets/img/favicon/favicon.ico" type="image/x-icon">

    <!--Manifest -->
    <link rel="manifest" href="../assets/img/favicon/site.webmanifest" />

</head>

<body>

</body>

</html>