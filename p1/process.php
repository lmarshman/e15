<?php

session_start();

$input = $_POST['input'];

$input_l = strtolower($input);

$len = strlen($input);

$palindrome = true;

for ($i = 0; $i < $len / 2; $i++) {
if ($input_l[$i] != $input_l[$len - 1 - $i]) {
    $palindrome = false;
}
}


$vowels = ['a', 'e', 'i', 'o', 'u'];
for ($i = 0; $i < $len; $i++)  {
    if (in_array($input_l[$i], $vowels))
        $vowel_count += 1;
}


$letter_shift = $input;
$new_word = [];

for ($i = 0; $i < $len; $i++) 
{
    if (ctype_alpha($letter_shift[$i])) {
    }
        if (ctype_upper($letter_shift[$i])) {
            $old_letter = ord($letter_shift[$i]) - ord('A');
            $new_letter = ($old_letter + 1) % 26;
            $shifted_letter = chr($new_letter + ord('A'));
            $new_word[] = $shifted_letter;
        }
        if (ctype_lower($letter_shift[$i])) {
            $old_letter = ord($letter_shift[$i]) - ord('a');
            $new_letter = ($old_letter + 1) % 26;
            $shifted_letter = chr($new_letter + ord('a'));
            $new_word[] = $shifted_letter;
    } else {
        continue;
    }
}

$shift = implode('', $new_word);

$_SESSION['results'] = [
    'letter_shift' => $shift,
    'input' => $input,
    'palindrome' => $palindrome,
    'vowel_count' => $vowel_count,
];


header('Location: index.php');