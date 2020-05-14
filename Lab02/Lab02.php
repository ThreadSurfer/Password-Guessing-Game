<?php

/**
* Student Name:            Joel Giladi
 * Student ID:              300302313
 * Assignment/File Name:    Lab02
 * 
 * Description: 
 * 
 * This portion describes the File/Assignment
 * 
 * References:
 * 
 * Please make sure you provide the appropriate url references
 * or any comment for example if you referenced some help you
 * received from your instructor or some demo code provided in
 * class.
 *   
 *      
**/

require('inc/passcode.inc.php');

// provide the initial value of passcode length. The value will be 
// modified in the initiateGame() 
$passcodeLength = 0;  

//Initiate the game and calculate the number of tries for the user
$tries = initiateGame($passcodeLength);

//Return the generated passcodes to be guessed!
$passcodes = generatePasscodes($passcodeLength);

//Construct the array we are going to use for the rest of the program based on the passcodes.
//Use list construct to get the arrays. $a, $b are example array variables
list($a,$b) = createArrays($passcodes);

//Display the masked version of the passcode on first instance. 
echo "\nGuess the following passcode: "; printMasked($a);
echo "Computer will guess the following passcode: "; printMasked($b);
 
// while the users still has tries
while ($tries > 0)
{

    // handle the guess of both players   
    handleGuess($a, $b);
    // check the status of both players' guesses
    checkStatus($a, $b);    

    //Tell the user how many tries they have left.  
    $tries--;
    echo "you have $tries chances left!";  
}

//If there's no more tries, print a message to the user and exit the game
echo "\nSorry, out of tries";

?>