<?php
include("./classes/class_person.php");

class BmiCalculator extends Person
{
    private $bodylength;
    private $bodymass;

    public function set_bodylength($bodylength)
    {
        if ($bodylength < 0.546 || $bodylength > 2.75) {
            echo "Uw lengte is hoogstwaarschijnlijk niet correct opgegeven";
            $this->bodylength = -1;
        } else {
            $this->bodylength = $bodylength;
        }
    }
    public function set_bodymass($bodymass)
    {
        if ($bodymass < 2 || $bodymass > 750) {
            echo "Uw massa is hoogstwaarschijnlijk niet correct opgegeven";
            $this->bodymass = 0;
        } else {
            $this->bodymass = $bodymass;
        }
    }
    public function get_bodylength()
    {
        return $this->bodylength . "m";
    }
    public function get_bodymass()
    {
        return $this->bodymass . "kg";
    }

    public function __construct($args = [])
    {
        $this->firstname = $args['firstname'] ?? 'voornaam onbekend';
        $this->infix = $args['infix'] ?? 'tussenvoegsel onbekend';
        $this->lastname = $args['lastname'] ?? 'achternaam onbekend';
        $bodymass = $args['bodymass'] ?? 0;
        $this->set_bodymass($bodymass);
        $this->bodylength = $args['bodylength'] ?? 1;
        $this->gender = $args['gender'] ?? 'geslacht onbekend';
        $this->streefgewicht = $args['streefgewicht'] ?? 1;
    }

    public function welkom()
    {
        echo "Hallo " . $this->make_full_name() . "<br>Je massa is " . $this->bodymass . "kg<br> Je lengte is: " . $this->bodylength . "m.<br>Je BMI-waarde is: " . $this->calculate_bmi() . "<br>" . $this->interpretation_bmi() . "<hr>";
    }

    public function calculate_bmi()
    {
        return round($this->bodymass / ($this->bodylength * $this->bodylength), 1);
    }

    public function interpretation_bmi()
    {
        $interpretation = "";
        $bmi = $this->calculate_bmi();
        switch (true) {
            case ($bmi < 18.5):
                $interpretation = "<div style='color:lightblue;'>U heeft ondergewicht</div>";
                break;
            case ($bmi >= 18.5 && $bmi < 25):
                $interpretation = "<div style='color:lime;'>U heeft normaal gewicht</div>";
                break;
            case ($bmi >= 25 && $bmi < 27):
                $interpretation = "<div style='color:lightgreen;'>U heeft licht overgewicht</div>";
                break;
            case ($bmi >= 27 && $bmi < 30):
                $interpretation = "<div style='color:lightgreen;'>U heeft matig overgewicht</div>";
                break;
            case ($bmi >= 30 && $bmi < 40):
                $interpretation = "<div style='color:orange;'>U heeft ernstig overgewicht</div>";
                break;
            case ($bmi >= 40):
                $interpretation = "<div style='color:red;'>U heeft ziekelijk overgewicht</div>";
                break;
            default:
                $interpretation = "Wij kunnen geen uitspraak doen over uw gewicht";
                break;
        }
        return $interpretation;
    }

    public function gender_icon($gender)
    {
        $icon = "";
        $value = $gender;
        switch (true) {
            case ($value == "male"):
                $icon = "<i class='fas fa-mars'></i>";
                break;
            case ($value == "female"):
                $icon = "<i class='fas fa-venus'></i>";
                break;
            case ($value == "trans"):
                $icon = "<i class='fas fa-transgender'></i>";
                break;
            default:
                $icon = "Er ging iets mis met uw geslacht.";
                break;
        }
        return $icon;
    }

    public function calc_streefgewicht()
    {
        return round(22.5 * $this->bodylength * $this->bodylength, 1);
    }

    public function streefgewicht()
    {
        $waarde = $this->calc_streefgewicht();
        return $waarde;
    }
}
