<!DOCTYPE html>
<html lang="en">

<head>
    <title>Project 1</title>
    <meta charset='utf-8'>
    <link href=data: , rel=icon>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body class="body">
    <div class="container text-center">
        <br>
        <h1>String Processor - e15 Project 1</h1>
        <h2>By Laura Marshman</h2>
    </div>
    <br>
    <br>
    <div class="mx-auto border border-success p-2 rounded" style="width: 550px;">
        <h3>Instructions</h3>
        <p>Enter a word to find out:</p>
        <ul>
            <li>Is it a Palindrome? (Same forwards and backwards)</li>
            <li>How many vowels does it contain</li>
            <li>What the word would look like if every letter was shifted +1 places in the alphabet</li>
        </ul>
    </div>
    <br>
    <div class="mx-auto" style="width: 540px;">
        <form method='POST' action='process.php'>
            <div class="mb-3">
                <label for='input' class="form-label">Enter a word:</label>
                <input type='text' class="form-control" name='input' id='input'>
                <br>
                <button type='submit' class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <br>

    <!--Checks if there is input from the User. If yes, it displays the results, if not, the
    below code is hidden-->
    <div class="mx-auto" style="width: 550px;">
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
    </div>

</body>

</html>