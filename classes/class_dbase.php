<?php

class Dbase
{
    private $servername = "www.bmi-calculator.com";
    private $username = "bmi_moderator";
    private $password = "D8LXppoEop9W9Y95";
    private $dbase = "bmi_calculator";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbase);
    }

    public function insert_record($raw_data)
    {
        $firstname = $this->sanitize($raw_data["firstname"]);
        $infix = $this->sanitize($raw_data["infix"]);
        $lastname = $this->sanitize($raw_data["lastname"]);
        $bodymass = $this->sanitize($raw_data["bodymass"]);
        $bodylength = $this->sanitize($raw_data["bodylength"]);
        $age = $this->sanitize($raw_data["age"]);
        $gender = $this->sanitize($raw_data["gender"]);

        $sql = "INSERT INTO `bmi_data` (`id`,
                                    `firstname`, 
                                    `infix`, 
                                    `lastname`, 
                                    `bodymass`, 
                                    `bodylength`, 
                                    `age`, 
                                    `gender`) 
                            VALUES (NULL, 
                                    '$firstname', 
                                    '$infix', 
                                    '$lastname', 
                                    '$bodymass', 
                                    '$bodylength', 
                                    '$age', 
                                    '$gender')";
        $this->conn->query($sql);
        header("Location: ./index.php");
    }

    private function sanitize($raw_data)
    {
        $data = htmlspecialchars($raw_data);
        $data = $this->conn->real_escape_string($data);
        return $data;
    }

    public function select_all()
    {
        include("./classes/class_bmicalculator.php");
        $sql = "SELECT * FROM `bmi_data`";
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $bmi_calc = new BmiCalculator(["bodymass" => $row["bodymass"], "bodylength" => $row["bodylength"]]);
            echo "<tr>
            <th scope='row'>" . $row["id"] . "</th>
            <td>" . $row["firstname"] . "</td>
            <td>" . $row["infix"] . "</td>
            <td>" . $row["lastname"] . "</td>
            <td>" . $row["bodymass"] . "</td>
            <td>" . $row["bodylength"] . "</td>
            <td>" . $row["age"] . "</td>
            <td>" . $bmi_calc->gender_icon($row["gender"]) . "</td>
            <td>" . $bmi_calc->calculate_bmi() . "</td>
            <td>" . $bmi_calc->interpretation_bmi() . "</td>
            <td>" . $bmi_calc->streefgewicht() . "</td>
            </tr>";
        }
    }
}
