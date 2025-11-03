<?php
require_once 'Pdo_methods.php';

class Date_time {

    private $pdo;
    private $sql;

    
    public function checkSubmit() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $time = $_POST["dateTime"];
            $note = $_POST["note"];
            if ($time === "" || $note === "") {
                return "You need to enter a date, time, and note.";
            }
            $timestamp = strtotime($time);
            $pdo = new PdoMethods();
            $sql = "INSERT INTO dateTime (date_time, note) VALUES (:date_time, :note)";
            $bindings = [
                [":date_time", "$timestamp", "int"],
                [":note", "$note", "str"]
            ];
            $result = $pdo->otherBinded($sql, $bindings);
            return "Note has been added";
        } else{
            return "";
        }
    }

    public function checkNote() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $start = $_POST["begDate"];
            $end = $_POST["endDate"];
            if ($start === "" || $end === "") {
                return "No notes found for the date range selected";
            }
            $startTimestamp = strtotime($start);
            $endTimestamp = strtotime($end);
            $pdo = new PdoMethods();
            $sql = "SELECT date_time, note FROM dateTime WHERE date_time BETWEEN :start AND :end ORDER BY date_time DESC";
            $bindings = [
                [":start", $startTimestamp, "int"],
                [":end", $endTimestamp, "int"]
            ];
            $records = $pdo->selectBinded($sql, $bindings);
            if ($records === "error" || empty($records)) {
                return "No notes found for the date range selected";
            } else {
            // Build HTML table
                $output = "<table class='table table-striped table-bordered'><thead><th>Date and Time</th><th>Note</th></td></thead><tbody>";
                foreach ($records as $row) {
                    $dateFormatted = date("m/d/Y g:i A", $row["date_time"]);
                    $output .= "<tr><td>{$dateFormatted}</td><td>{$row['note']}</td></tr>";
                }
                $output .= "</tbody></table>";

                return $output;
            }
        } else{
            return "";
        }  
    }
}
?>