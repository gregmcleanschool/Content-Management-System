<!-- TRYING TO FIGURE OUT HASHING, NOT GOING WELL -->


<?php
/**
 * Created by PhpStorm.
 * User: inet2005
 * Date: 12/1/14
 * Time: 3:32 PM
 */


$numberOfHash = 3000;
$enteredPassword = "greg";
$saltLength = 40;



//echo $salt;
$hash1;

$encrypted_mypassword=SHA1($enteredPassword);

$salt = openssl_random_pseudo_bytes ( $saltLength,$cstrong);
$hash1 = hash('sha1',$enteredPassword . $salt);

for($i = 0; $i<$numberOfHash; $i++)
{
    $encrypted_mypassword=SHA1($enteredPassword);
    $encrypted_mypassword =SHA1( $encrypted_mypassword);
    echo  $encrypted_mypassword. '</p>';
//echo $hash1 . "</p>";
//$hash2 = hash('sha1',$hash1);
//echo $hash2. "</p>";
}

echo  $encrypted_mypassword . '</p>';

$hash2;

for($i = 0; $i<$numberOfHash; $i++)
{
    $salt = openssl_random_pseudo_bytes ( $saltLength,$cstrong);
    $hash2 = hash('sha1',$enteredPassword . $salt);
//echo $hash1 . "</p>";
//$hash2 = hash('sha1',$hash1);
//echo $hash2. "</p>";
}

echo $hash2;



// apply $algorithm $runs times for slowdown
//while ($runs--) {
//    $string = hash($algorithm, $string . $salt, $raw);
//    echo $string . "</p>";
//}
//
//return $string;


//
//for($i = 0; $i<$numberOfHash; $i++)
//{
//$hash1 = hash('sha1',$enteredPassword);
//echo $hash1 . "</p>";
//$hash2 = hash('sha1',$hash1);
//echo $hash2. "</p>";
//}
//
//echo $hash1;
//$hash2 = $hash1

?>