<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .calculator { width: 300px; margin: 100px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        input[type="text"], input[type="submit"] { width: 100%; padding: 10px; margin: 5px 0; }
        input[type="button"] { width: 70px; margin: 5px; }
    </style>
</head>
<body>
    <div class="calculator">
        <form method="post" action="">
            <input type="text" name="number1" placeholder="Enter first number" required>
            <input type="text" name="number2" placeholder="Enter second number" required>
            <input type="submit" name="operation" value="Add">
            <input type="submit" name="operation" value="Subtract">
            <input type="submit" name="operation" value="Multiply">
            <input type="submit" name="operation" value="Divide">
            <input type="submit" name="operation" value="Clear">
        </form>
        <h3>Result: 
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $num1 = $_POST['number1'];
                $num2 = $_POST['number2'];
                $operation = $_POST['operation'];

                if ($operation == "Add") {
                    echo $num1 + $num2;
                } elseif ($operation == "Subtract") {
                    echo $num1 - $num2;
                } elseif ($operation == "Multiply") {
                    echo $num1 * $num2;
                } elseif ($operation == "Divide") {
                    if ($num2 != 0) {
                        echo $num1 / $num2;
                    } else {
                        echo "Cannot divide by zero!";
                    }
                } elseif ($operation == "Clear") {
                    echo "";
                }
            }
            ?>
        </h3>
    </div>
</body>
</html>