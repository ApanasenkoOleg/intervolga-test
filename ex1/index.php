<?php
$data = [
    ['Иванов', 'Математика', 5],
    ['Иванов', 'Математика', 4],
    ['Иванов', 'Математика', 5],
    ['Петров', 'Математика', 5],
    ['Сидоров', 'Физика', 4],
    ['Иванов', 'Физика', 4],
    ['Петров', 'ОБЖ', 4],
];

// Суммируем баллы по ученикам и предметам
$results = [];
foreach ($data as $entry) {
    list($student, $subject, $score) = $entry;
    if (!isset($results[$student])) {
        $results[$student] = [];
    }
    if (!isset($results[$student][$subject])) {
        $results[$student][$subject] = 0;
    }
    $results[$student][$subject] += $score;
}

// Получаем список всех предметов
$subjects = [];
foreach ($results as $studentSubjects) {
    foreach ($studentSubjects as $subject => $score) {
        $subjects[$subject] = true;
    }
}
$subjects = array_keys($subjects);
sort($subjects);

// Сортируем учеников
ksort($results);

// Выводим таблицу
echo '<table border="1">';
echo '<tr><th></th>';
foreach ($subjects as $subject) {
    echo "<th>$subject</th>";
}
echo '</tr>';

foreach ($results as $student => $studentSubjects) {
    echo '<tr>';
    echo "<td>$student</td>";
    foreach ($subjects as $subject) {
        $score = isset($studentSubjects[$subject]) ? $studentSubjects[$subject] : '';
        echo "<td>$score</td>";
    }
    echo '</tr>';
}

echo '</table>';
?>
