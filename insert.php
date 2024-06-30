<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Izdeliya";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$details = $_POST['details'];
$labor = $_POST['labor'];
$cost = $_POST['cost'];

if (is_numeric($details) && $details >= 0 && is_numeric($labor) && $labor >= 0 && is_numeric($cost) && $cost >= 0) {
    $sql = "INSERT INTO Izdeliya (Naimenovanie, Kolichestvo_detaley, Trudoemkost, Stoimost) 
            VALUES ('$name', '$details', '$labor', '$cost')";

    if ($conn->query($sql) === TRUE) {
        echo "Запись успешно добавлена.<br>";
        // Отображение всех записей
        $result = $conn->query("SELECT * FROM Izdeliya");

        if ($result->num_rows > 0) {
            echo "<h2>Все записи:</h2><table border='1'><tr><th>Наименование</th><th>Количество деталей</th><th>Трудоемкость</th><th>Стоимость</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Naimenovanie"] . "</td><td>" . $row["Kolichestvo_detaley"] . "</td><td>" . $row["Trudoemkost"] . "</td><td>" . $row["Stoimost"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Нет записей";
        }
    } else {
        echo "Ошибка: " . $conn->error;
    }
} else {
    echo "Ошибка: Количество деталей, трудоемкость и стоимость не могут быть отрицательными.";
}

echo '<br><a href="add_record.html">Добавить еще одну запись</a><br>';
echo '<a href="index.html">Вернуться на главную</a>';

$conn->close();
