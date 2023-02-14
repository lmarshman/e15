<?php

session_start();

# If statement checks if there is user input.
if (isset($_SESSION['results'])) {
    $results = $_SESSION['results'];

    $palindrome = $results['palindrome'];
    $vowel_count = $results['vowel_count'];
    $letter_shift = $results['letter_shift'];
    $input = $results['input'];
    
    # Clears session variables.
    $_SESSION['results'] = null;
}

require 'index-view.php';