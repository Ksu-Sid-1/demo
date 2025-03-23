<?php
class Collatz {
    private $startNumber;
    private $results = [];

    public function __construct($startNumber) {
        $this->startNumber = $startNumber;
    }

    public function calculateInterval($start, $end) {
        for ($i = $start; $i <= $end; $i++) {
            $this->results[$i] = $this->calculate($i);
        }
    }

    private function calculate($number) {
        $iterations = 0;
        $maxValue = $number;

        while ($number != 1) {
            if ($number % 2 == 0) {
                $number = $number / 2;
            } else {
                $number = 3 * $number + 1;
            }
            $iterations++;
            $maxValue = max($maxValue, $number);
        }

        return ['iterations' => $iterations, 'maxValue' => $maxValue];
    }

    public function statistics() {
        $maxIterations = -1;
        $minIterations = PHP_INT_MAX;
        $maxValue = -1;

        $numberWithMaxIterations = null;
        $numberWithMinIterations = null;
        $numberWithMaxValue = null;

        foreach ($this->results as $number => $data) {
            if ($data['iterations'] > $maxIterations) {
                $maxIterations = $data['iterations'];
                $numberWithMaxIterations = $number;
            }

            if ($data['iterations'] < $minIterations) {
                $minIterations = $data['iterations'];
                $numberWithMinIterations = $number;
            }

            if ($data['maxValue'] > $maxValue) {
                $maxValue = $data['maxValue'];
                $numberWithMaxValue = $number;
            }
        }

        return [
            'numberWithMaxIterations' => $numberWithMaxIterations,
            'numberWithMinIterations' => $numberWithMinIterations,
            'numberWithMaxValue' => $numberWithMaxValue
        ];
    }
}

