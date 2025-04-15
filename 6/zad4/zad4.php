<?php
function mnozenie($matrixA, $matrixB) {
    $rowsA = count($matrixA);
    $colsA = count($matrixA[0]);
    $rowsB = count($matrixB);
    $colsB = count($matrixB[0]);

    if ($colsA !== $rowsB) {
        echo ("Nie można mnożyć: liczba kolumn w A musi być równa liczbie wierszy w B.");
    }

    $result = array_fill(0, $rowsA, array_fill(0, $colsB, 0));

    for ($i = 0; $i < $rowsA; $i++) {
        for ($j = 0; $j < $colsB; $j++) {
            for ($k = 0; $k < $colsA; $k++) {
                $result[$i][$j] += $matrixA[$i][$k] * $matrixB[$k][$j];
            }
        }
    }

    return $result;
}
$A = [
    [1, 2, 2],
    [3, 4, 4],
    [5, 5, 6]
];

$B = [
    [5, 6, 2],
    [7, 8, 3],
    [6, 5, 4]
];
$C = mnozenie($A, $B);
print_r($C);
?>