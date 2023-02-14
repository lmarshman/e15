<?php

session_start();

# Global variable that stores the input from the user.
$input = $_POST['input'];


# Makes the string all lowercase letters.
$input_l = strtolower($input);
/* This variable is used to simplify the palindrome and vowel counting loops. 
It removes no alphabetic characters from the string.*/
$input_pr = preg_replace("/[^a-z]/", '', $input_l);

# Sets the palindrome variable to true.
$palindrome = true;

/* This loop is responsible for determining if the user's word is a palindrome. It compares the 
first and last letter and indexs inward until either the letters don't match, or it completes
the loop.*/
for ($i = 0; $i < strlen($input_l) / 2; $i++) {
    if ($input_pr[$i] != $input_pr[$len - 1 - $i]) {
        $palindrome = false;
    }
}

# Lines 28-37 determine how many vowels are in the user's word.
$vowels = ['a', 'e', 'i', 'o', 'u'];

/* The loop checks each letter of the string to see if it appears in the vowels array. If yes,
it adds 1 to the vowel_count varaible.*/ 
for ($i = 0; $i < strlen($input); $i++)  {
    if (in_array($input_l[$i], $vowels)) {
        $vowel_count += 1;
    }
}

# This variable captures the original user's input so that the case of each letter can be preserved.
$letter_shift = $input;
# Array to store the shfited letters.
$new_word = [];

for ($i = 0; $i < strlen($input); $i++) {
    # If the letter is in the alphabet, it completes the letter shift. If not, it is ignored.
    if (ctype_alpha($letter_shift[$i])) {
    }
        # This loop accounts for shifting uppercase letters
        if (ctype_upper($letter_shift[$i])) {
            # ord() finds the ASCII value of each letter - the ASCII value of capital A.
            $old_letter = ord($letter_shift[$i]) - ord('A');
            # Math for shifting the letter by 1 and being able to wrap from Z to A.
            $new_letter = ($old_letter + 1) % 26;
            # chr() converts the ASCII value to the letter
            $shifted_letter = chr($new_letter + ord('A'));
            # Adds new letter to storage array.
            $new_word[] = $shifted_letter;
        }
        /* This loop accounts for shifting lowercase letters. It's the same process as 
        shifting uppercase letters except that it uses lowercase a ASCII values
        for it's calculations*/
        if (ctype_lower($letter_shift[$i])) {
            $old_letter = ord($letter_shift[$i]) - ord('a');
            $new_letter = ($old_letter + 1) % 26;
            $shifted_letter = chr($new_letter + ord('a'));
            $new_word[] = $shifted_letter;
    /*I had originally had this as an else statement but for some reason it was adding letters
    and capitalizing them. Changing it to a more direct elseif statement seemed to solve the 
    problem, though I'm not clear on why exactly. */
    } elseif (!ctype_alpha($letter_shift[$i])) {
        $new_word[] = $letter_shift[$i];
    }
}
# The implode function removes the spaces in the array and creates the new shifted word.
$shift = implode('', $new_word);

# Session variables I want available to my index.php file
$_SESSION['results'] = [
    'letter_shift' => $shift,
    'input' => $input,
    'palindrome' => $palindrome,
    'vowel_count' => $vowel_count,
    'input_pr' => $input_pr
];

header('Location: index.php');