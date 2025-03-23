<?php
function collatz($x) {
    // Start the sequence with the initial value
    $sequence = [$x];

    // Continue the sequence until we reach 1
    while ($x != 1) {
        if ($x % 2 == 0) {
            // If x is even, divide it by 2
            $x = $x / 2;
        } else {
            // If x is odd, multiply by 3 and add 1
            $x = 3 * $x + 1;
        }
        // Append the new value to the sequence
        $sequence[] = $x;
    }
    return $sequence;
}

// Test the function with a sample value
$x = 6;
$sequence = collatz($x);
echo "Collatz sequence for $x: " . implode(" -> ", $sequence) . "\n";
?>



