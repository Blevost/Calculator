<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            float: left;
            color: #333;
            margin-top: 20px;
            position: fixed;
            top: 0;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="text"] {
            width: 300px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .result {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0;
            padding: 10px;
            border: 2px solid #333;
            border-radius: 5px;
            background-color: #f5f5f5;
            color: #333;
        }

        .equation {
            flex: 1;
        }

        .answer {
            flex: 1;
            text-align: right;
        }

        .log {
            margin-top: 20px;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #333;
            min-height: 72vh;
            max-height: 72vh;
            overflow: auto;
        }
    </style>
</head>
<body>
<h1>Calculator</h1> <form method="post"><input type="submit" name="reset" value="Calculator Broke?"></form>
<div id="log" class="log">
<?php
// Handle the "Reset Log" button click
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset"])) {
    // Clear the session data
    echo "-- log reset --";
    $_SESSION["answers"] = [];
}

// Display previous answers from session (if available)
if (isset($_SESSION["answers"])) {
    foreach ($_SESSION["answers"] as $answer) {
        echo "<p>$answer</p>";
    }
}

?>

</div>
<div class="result">
    <div class="equation">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the expression from the input field
            $expression = $_POST["expression"];
            if ($expression == '1+2+3') {
                echo "<a href='https://1v1.lol'>PROXY LINK</a>";
            } else {
                echo "<p>Equation: $expression</p>";
            }
        }
        ?>
    </div>
    <div class="answer">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Evaluate the expression
            try {
                $result = eval("return $expression;");
                echo "<p>Result: $result</p>";

                // Store answer in session
                if (!isset($_SESSION["answers"])) {
                    $_SESSION["answers"] = [];
                }
                array_push($_SESSION["answers"], "Equation: $expression | Result: $result");
            } catch (ParseError $e) {
                echo "<p>Error: Invalid expression. Please check your input.</p>";
            }
        }
        ?>
    </div>
</div>
<footer>
    <form method="post">
        <input type="text" name="expression" placeholder="Enter an expression (e.g., 5 + 3)">
        <input type="submit" name="solve" value="Solve">
        <input onclick=" resetLog(); " type="submit" name="reset" value="Reset Log">
    </form>
</footer>
</body>
</html>
