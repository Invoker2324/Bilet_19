<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Izdeliya";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = $_POST['action'];

if ($action == "Найти изделия по количеству деталей") {
    $details_count = $_POST['details_count'];
    if (is_numeric($details_count) && $details_count >= 0) {
        $sql = "SELECT * FROM Izdeliya WHERE Kolichestvo_detaley >= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $details_count);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<h2>Найденные изделия:</h2><table border='1'><tr><th>Наименование</th><th>Количество деталей</th><th>Трудоемкость</th><th>Стоимость</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Naimenovanie"] . "</td><td>" . $row["Kolichestvo_detaley"] . "</td><td>" . $row["Trudoemkost"] . "</td><td>" . $row["Stoimost"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Нет изделий с таким количеством деталей.";
        }
        $stmt->close();
    } else {
        echo "Введите корректное количество деталей (целое неотрицательное число).";
    }
}

if ($action == "Найти изделия по стоимости") {
    $max_cost = $_POST['max_cost'];
    if (is_numeric($max_cost) && $max_cost >= 0) {
        $sql = "SELECT Naimenovanie, Trudoemkost FROM Izdeliya WHERE Stoimost < ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("d", $max_cost); 
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<h2>Найденные изделия:</h2><table border='1'><tr><th>Наименование</th><th>Трудоемкость</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Naimenovanie"] . "</td><td>" . $row["Trudoemkost"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Нет изделий с такой стоимостью.";
        }
        $stmt->close();
    } else {
        echo "Введите корректную стоимость (неотрицательное число).";
    }
}

if ($action == "Найти изделия по названию") {
    $name_string = $_POST['name_string'];
    if (strlen($name_string) <= 20) {
        $sql = "SELECT * FROM Izdeliya WHERE Naimenovanie LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name_string); 
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<h2>Найденные изделия:</h2><table border='1'><tr><th>Наименование</th><th>Количество деталей</th><th>Трудоемкость</th><th>Стоимость</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Naimenovanie"] . "</td><td>" . $row["Kolichestvo_detaley"] . "</td><td>" . $row["Trudoemkost"] . "</td><td>" . $row["Stoimost"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "Нет изделий с такой строкой в названии.";
        }
        $stmt->close();
    } else {
        echo "Введите строку не длиннее 20 символов.";
    }
}

if ($action == "Обновить стоимость") {
    $name_update = $_POST['name_update'];
    $new_cost = $_POST['new_cost'];
    if (is_numeric($new_cost) && $new_cost >= 0 && strlen($name_update) <= 20) {
        $sql = "UPDATE Izdeliya SET Stoimost = ? WHERE Naimenovanie = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ds", $new_cost, $name_update); 
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Стоимость обновлена успешно для изделия: $name_update";
        } else {
            echo "Ошибка обновления стоимости.";
        }
        $stmt->close();
    } else {
        echo "Введите корректную стоимость (неотрицательное число) и название изделия не длиннее 20 символов.";
    }
}

if ($action == "Удалить запись") {
    $id_delete = $_POST['id_delete'];
    if (is_numeric($id_delete) && $id_delete > 0) {
        $sql = "DELETE FROM Izdeliya WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_delete);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Запись удалена успешно";
        } else {
            echo "Ошибка удаления записи.";
        }
        $stmt->close();
    } else {
        echo "Введите корректный ID записи (целое положительное число).";
    }
}

echo '<br><a href="queries.html">Вернуться к запросам</a><br>';
echo '<a href="index.html">Вернуться на главную</a>';

$conn->close();
