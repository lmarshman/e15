<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project 1</title>
    <meta charset='utf-8'>
    <link href=data: , rel=icon>
</head>

<body>
    <h1>String Processor - e15 Project 1</h1>
    <h2>By Laura Marshman</h2>

    <h3>Instructions</h3>
    <p>Enter a word to find out:</p>
    <ul>
        <li>Is it a Palindrome? (Same forwards and backwards)</li>
        <li>How many vowels does it contain</li>
        <li>What the word would look like if every letter was shifted +1 places in the alphabet</li>
    </ul>
    <form method='POST' action='process.php'>
        <label for='input'>Your word:</label>
        <input type='text' name='input' id='input'>
        <button type='submit'>Submit</button>
    </form>

    <!--Checks if there is input from the User. If yes, it displays the results, if not, the
    below code is hidden-->
    <?php if (isset($input)) { ?>
    <h2>Results for: <?php echo $input; ?></h2>
    <!--Displays the results for whether or not the user input is a palindrome.-->
    <p>Is it a palindrome? <?php if ($palindrome) { ?>
        Yes
        <?php } else { ?>
        No
        <?php } ?> </p>
    <!--Displays the amount of vowels the user input has.-->
    <p>How many vowels does it have? <?php if ($vowel_count < 1) { ?>
        0
        <?php } else { ?>
        <?php echo $vowel_count; ?>
        <?php } ?> </p>
    <!--Displays the shift version of the user input word-->
    <p>Letter shift: <?php echo $letter_shift; ?></p>
    <?php } ?>
</body>

</html>