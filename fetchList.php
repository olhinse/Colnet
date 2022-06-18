<?php
try {
    function fetchList($column, $table) {
        include "pdo.php";
        $stmt = $conn->prepare(
            "SELECT $column FROM $table"
        );
        $stmt->execute();
        $List = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($List); $i++) {
            echo "<option>" . $List[$i][$column] . "</option>";
        }
    }
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
