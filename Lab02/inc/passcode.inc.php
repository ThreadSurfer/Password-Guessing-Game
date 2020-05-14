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

// This function print the game's header, prompt for the passcode length input
// and calculate/return the number of tries
function initiateGame(&$length){
    echo "================================================\n"
    ."Two players guessing game by Joel\n"
    ."================================================\n"
    ."Enter the length of the passcode for game selection";

    $length = readline(" ");
    while ($length > 20) {
        echo "maximum password length is 20, please re-enter length of password";
        $length = readline(" ");
    }
    if($length * 3 < 10) //# of tries are = to password length * 3, up to a max of 10 tries.
        $tries = $length * 3;
    else $tries = 10;
    
    return $tries;
}

function maxOccurence(&$text, $string){
    echo subtstr_count($text, '$string');
    return substr_count($text, '$string');
}

//This function generate the two passcodes. 
//Remember the rule that any digit in the passcode cannot be repeated more than twice
function generatePasscodes($length)  {
    $passcode1 = [];
    $passcode2 = [];

    for($i = 0; $i < $length; $i++){

        if(sizeof($passcode1) == 0){
            $num1 = rand(0, 9);
            array_push($passcode1, $num1);
        }
        else {
            do {
                $num1 = rand(0, 9);
                $count = 0;
                foreach($passcode1 as $value){
                    if ($value == $num1){
                        $count++;
                    }
                 }
                } while ($count >= 2); // Ensure that no more than 2 digits are allowed for passwords
                array_push($passcode1, $num1);
            }

        if(sizeof($passcode2) == 0){
                $num2 = rand(0, 9);
                array_push($passcode2, $num2);
        }
            else {
                do {
                    $num2 = rand(0, 9);
                    $count = 0;
                    foreach($passcode2 as $value){
                        if ($value == $num2){
                            $count++;
                        }
                     }
                    } while ($count >= 2);
                    array_push($passcode2, $num2);
                }

    }
    $passcodes = [$passcode1, $passcode2];
    
    return $passcodes;
    }

//This function create the datastructure (arrays) to track the user progress in the game
    function createArrays($passcodes)    {
        $passcode1 = [];
        $passcode2 = [];
        foreach($passcodes[0] as $key => $value){
            $passcode1[$key] = [$value, "*"]; //Passwords get encrypted with an asterisk ($key[1]).
            // the $value ($key[0]) will be displayed once a user enters a correct guess.
            //In other methods, I replace the $key keyword with $value. So $key[0] and $key[1] are refered to as $value[0] and $value[1]
        }
        foreach($passcodes[1] as $key => $value){
            $passcode2[$key] = [$value, "*"];
        }

        $passcodeArrays = [$passcode1, $passcode2];


    return $passcodeArrays;
}

//This function prints out the passcodes in its masked form.
function printMasked(& $passcodeArray)  {
    foreach($passcodeArray as $value){
        echo $value[1]; //By default, all value[1] positions are an asterisk *. They get changed to the same number as value[0] if a user finds the correct answer.
    }
    echo "\n";
}

//This function handles the user and computer guesses and print the masked version of the passcodes
function handleGuess(& $passcodeArray1, & $passcodeArray2)   {
   echo "\n";
   $userGuess = readline("Please enter a guess: ");
   while ($userGuess > 9){
    $userGuess = readline("Invalid number, please enter a number from 0 - 9: ");
   }

   foreach($passcodeArray1 as $key => $value){ //This method checks if a userguess matches a value[0] in the password
    if ($userGuess == $value[0]){
        $value[1] = $value[0];
        $passcodeArray1[$key] = [$value[0], $value[1]]; //Assign the value to value[1] position.
    }
    }

    echo "Your challenge passcode: "; printMasked($passcodeArray1); //value[1] positions get printed. All switched value[1]'s now get displayed as a digit.
    echo "\n";

   $computerGuess = rand(0, 9);
    echo "Computer guess: $computerGuess\n";

    foreach($passcodeArray2 as $key => $value){
        if ($computerGuess == $value[0]){
            $value[1] = $value[0];
            $passcodeArray2[$key] = [$value[0], $value[1]];
            }
        }
    echo "Computer's challenge passcode: "; printMasked($passcodeArray2);
    echo "\n";

    }

//This function checks to see if both the user and computer has entered all the correct characters or not
//and print a corresponding message
function checkStatus(& $passcodeArray1, & $passcodeArray2)    {
    $userWin = TRUE;
    $count = 0;
    $computerWin = TRUE;

    foreach($passcodeArray1 as $value){ //Check in the array if any value[1]'s remain as asterisk *.
        if ($value[1] === "*"){ 
        $userWin = FALSE; // If an asterisk is found, it means not all values have been found.
            } 
        }

    foreach($passcodeArray2 as $value){
        if ($value[1] === "*")
            $computerWin = FALSE;
        }
      

    switch($userWin){
        case TRUE:
            if($computerWin)
                echo exit("You draw with the computer. Cool!");
            
            else exit( "You won against the computer. You're a wizzard!");
        break;
        case FALSE:
            if($computerWin)
                exit("Sorry you lost!");
        break;

        }

    
    }


    
?>