<?php
// Function to perform the 3x+1 calculation
function collatz($num) {
    $values = [$num];
    $maxValue = $num;
    $iterations = 0;

    while ($num != 1) {
        if ($num % 2 == 0) {
            $num = $num / 2;
        } else {
            $num = 3 * $num + 1;
        }
        $values[] = $num;
        $maxValue = max($maxValue, $num);
        $iterations++;
    }

    return [
        "values" => $values,
        "maxValue" => $maxValue,
        "iterations" => $iterations
    ];
}

// Function to calculate the range values
function processRange($start, $finish) {
    $results = [];

    for ($i = $start; $i <= $finish; $i++) {
        $result = collatz($i);
        $results[] = [
            "number" => $i,
            "maxValue" => $result["maxValue"],
            "iterations" => $result["iterations"]
        ];
    }

    return $results;
}

// Function to find numbers with max and min iterations and highest values
function analyzeResults($results) {
    $maxIterations = max(array_column($results, 'iterations'));
    $minIterations = min(array_column($results, 'iterations'));
    $highestValue = max(array_column($results, 'maxValue'));

    $numberMaxIteration = array_filter($results, fn($x) => $x['iterations'] === $maxIterations);
    $numberMinIteration = array_filter($results, fn($x) => $x['iterations'] === $minIterations);
    $numberHighestValue = array_filter($results, fn($x) => $x['maxValue'] === $highestValue);

    return [
        "maxIterationNumber" => array_values($numberMaxIteration)[0],
        "minIterationNumber" => array_values($numberMinIteration)[0],
        "highestValueNumber" => array_values($numberHighestValue)[0]
    ];
}

// HTML form and execution
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = (int)$_POST['start'];
    $finish = (int)$_POST['finish'];

    if ($start > 0 && $finish >= $start) {
        $results = processRange($start, $finish);
        $analysis = analyzeResults($results);

        echo "<h3>Results:</h3>";
        echo "Number with Max Iterations: " . $analysis['maxIterationNumber']['number'] . "<br>";
        echo "Number with Min Iterations: " . $analysis['minIterationNumber']['number'] . "<br>";
        echo "Number with Highest Value: " . $analysis['highestValueNumber']['number'] . "<br>";
    } else {
        echo "Please provide valid range values.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>3x+1 Collatz Analysis</title>
</head>
<body>
    <h2>Enter Range for Collatz Calculation</h2>
    <form method="post">
        <label for="start">Start Number:</label>
        <input type="number" id="start" name="start" required><br><br>
        <label for="finish">Finish Number:</label>
        <input type="number" id="finish" name="finish" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
