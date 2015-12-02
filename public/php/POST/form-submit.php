
<?php

include "../../../includes/mandrill-api-php/src/Mandrill.php";
include "../../customer-email.php";


$message = "<h2>Artist Submission </h2>";

$message .= "<p>You have had a submission from a potential artist</p>";

$message .= "<table>";

$message .= "<tr><td>Name</td><td>".$_POST["name"]."</td></tr>";    
$message .= "<tr><td>Email</td><td>".$_POST["email"]."</td></tr>";    
$message .= "<tr><td>Website</td><td>".$_POST["website"]."</td></tr>";    
$message .= "<tr><td>Instagram</td><td>".$_POST["instagram-username"]."</td></tr>";    
$message .= "<tr><td>Facebook</td><td>".$_POST["facebook-username"]."</td></tr>";    
$message .= "<tr><td>Other</td><td>".$_POST["other"]."</td></tr> ";   
$message .= "<tr><td>Bio</td><td>".$_POST["bio"]."</td></tr>";
$message .= "<tr><td>Copyright</td><td>".$_POST["copyright"]."</td></tr>";
$message .= "<tr><td>Marketing</td><td>".$_POST["marketing"]."</td></tr>";
    
$message .= "<tr><td>Image 1</td><td><img src='http://theclubofoddvolumes.com/assets/custom-image-uploads/".$_POST["image-id-1"]."'></td></tr>";
$message .= "<tr><td>Image 2</td><td><img src='http://theclubofoddvolumes.com/assets/custom-image-uploads/".$_POST["image-id-2"]."'></td></tr>";
$message .= "<tr><td>Image 3</td><td><img src='http://theclubofoddvolumes.com/assets/custom-image-uploads/".$_POST["image-id-2"]."'></td></tr>";
    
$message .= "</table>";

$to = "shop@theclubofoddvolumes.com";
sendreceipt($message,$to,"Sarah","Artist Request");

echo "success";

?>