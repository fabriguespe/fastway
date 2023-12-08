

<?php 


header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(isset($_POST['submit'])) {
        
    $host=$_SERVER['HTTP_HOST'];
    if($host==='fastway')$con=mysqli_connect('localhost', 'root', 'root', 'ecom3');
    else {
        $host=explode('-',gethostname())[1];
        $pass="";
        /*
        http://ecomaltoweb.kinsta.cloud/wp-content/themes/fastway/stats.php
        http://altoweb.kinsta.cloud/wp-content/themes/fastway/stats.php
        http://ecom2.kinsta.cloud/wp-content/themes/fastway/stats.php
        http://ecom3.kinsta.cloud/wp-content/themes/fastway/stats.php
        http://insti2.kinsta.cloud/wp-content/themes/fastway/stats.php
        */
        if($host=='ecomaltoweb')$pass="AzTqSBeLgPxjaeT";
        else if($host=='altoweb')$pass="kByecetGFisPWnS";
        else if($host=='ecom2')$pass="iYOIxmdkxXnuJb4";
        else if($host=='ecom3')$pass="zulinVXs3DLo2Nh";
        else if($host=='insti2')$pass="PzpevImJBia4PnJ";
        $con=mysqli_connect('localhost', $host, $pass, $host);
    }
    $killuser= $_POST['killuser'];

    // sql to delete a record that matches the variable (killuser) from the web form
    $sql = "DELETE FROM wp_signups WHERE user_email LIKE '$killuser'";
     
    //then the confirmation or non-confirmation message
    if ($con->query($sql) === TRUE) {
        echo "Zombie Destroyed. Go in peace.";
    } else {
        echo "You cannot kill me! Error deleting record: " . $con->error;
    }
}

?>

<form action="deduplicate.php" method="post">
    Email to destroy: <input type="text" name="killuser" /><br />
    <input type="submit" name="submit" value="Unblock" />
</form>