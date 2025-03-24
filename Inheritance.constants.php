<?php
// Parent class for 3x + 1
class Collatz {
    // Protected variable to track iterations
    protected $iterations;

    public function __construct() {
        $this->iterations = 0; // Initialize iterations
    }

    // Public method to calculate the 3x + 1 sequence
    public function calculateSequence($x) {
        $sequence = [];
        while ($x != 1) {
            $sequence[] = $x; // Add the current value to the sequence
            $this->iterations++;
            if ($x % 2 == 0) { // Even number
                $x /= 2;
            } else { // Odd number
                $x = 3 * $x + 1;
            }
        }
        $sequence[] = 1; // Add the final 1 to the sequence
        return $sequence;
    }
}

// Child class extending Collatz
class CollatzStatistics extends Collatz {
    // Constants for interval validation
    const MIN_VALUE = 1;      // Minimum allowed value
    const MAX_VALUE = 10000;  // Maximum allowed value

    // Private variable to store histogram data
    private $histogram;

    public function __construct() {
        parent::__construct(); // Initialize parent class
        $this->histogram = []; // Initialize histogram as an empty array
    }

    // Public method to calculate histogram
    public function calculateHistogram($n, $m) {
        // Validate the interval
        if ($n < self::MIN_VALUE || $m > self::MAX_VALUE || $n > $m) {
            throw new Exception("Values must be within [" . self::MIN_VALUE . ", " . self::MAX_VALUE . "] and n <= m.");
        }

        $this->histogram = []; // Reset histogram
        for ($x = $n; $x <= $m; $x++) {
            $this->iterations = 0; // Reset iterations for each number
            $this->calculateSequence($x);
            $count = $this->iterations;

            // Populate histogram
            if (isset($this->histogram[$count])) {
                $this->histogram[$count]++;
            } else {
                $this->histogram[$count] = 1;
            }
        }

        return $this->histogram;
    }

    // Public method to display histogram
    public function displayHistogram() {
        echo "Iterations : Count\n";
        foreach ($this->histogram as $iterations => $count) {
            echo str_pad($iterations, 10, " ", STR_PAD_LEFT) . " : " . $count . "\n";
        }
    }
}

// Example usage
try {
    $collatzStats = new CollatzStatistics();
    $histogram = $collatzStats->calculateHistogram(5, 15);
    $collatzStats->displayHistogram();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
