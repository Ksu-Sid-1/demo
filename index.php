<?php
require_once 'collatz1.php'; // Updated to use collatz1.php

// Initialize with a starting number (optional, not strictly used here)
$collatz = new Collatz(1);

// Perform calculations for an interval
$collatz->calculateInterval(25, 24658);

// Fetch and display statistics
$stats = $collatz->statistics();
echo "Number with max iterations: " . $stats['numberWithMaxIterations'] . PHP_EOL;
echo "Number with min iterations: " . $stats['numberWithMinIterations'] . PHP_EOL;
echo "Number with max reached value: " . $stats['numberWithMaxValue'] . PHP_EOL;
