<?php
include("../config/connection.php");
require("functions.php");

$brGresaka;
$code = "";
$odgovor = "";

if (isset($_POST['btnKlik'])) {
    if (!empty($konekcija)) {
        $brGresaka = 0;
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $regexName = "/^[A-ZŠĐŽĆČ][a-zšđžćč]{2,15}(\s[A-ZŠĐŽĆČ][azšđžćč]{2,15})?$/";
        $regexEmail = "/^([a-z]{3,11}(\d)*)(\.)?([a-z]{3,11}(\d)*)\@(gmail.com|hotmail.com|yahoo.com|outlook.com)$/";
        $regexPassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/";

        ValidateRegex($regexName, $first_name, "First name is not in the correct format. Example: Djordje");
        ValidateRegex($regexName, $last_name, "Last name is not in the correct format. Example: Tesic");
        ValidateRegex($regexEmail, $email, "Email is not in the correct format. Example: djordjetesic@gmail.com");
        ValidateRegex($regexPassword, $password, "Your password must contain at least one lowercase letter, one uppercase letter, one number, and be at least 8 characters long.");

        if ($brGresaka == 0) {
            $kriptovana_sifra = md5($password);
            $provera_emaila = "SELECT * FROM users WHERE email=:email";
            $preparacija_provere = $konekcija->prepare($provera_emaila);
            $preparacija_provere->bindParam(":email", $email);
            $preparacija_provere->execute();

            $rezultat = $preparacija_provere->fetch();

            if ($rezultat) {
                $code = ["code" => 409];
            } else {
                $upit_za_unos = "INSERT INTO users(first_name, last_name, email, password, picture, role_id, banned) VALUES (:first_name, :last_name, :email, :password, :picture, :role_id, :banned)";
                $picture = "user.png";
                $role_id = 2;
                $banned = 0;

                $preparacija_unosa = $konekcija->prepare($upit_za_unos);
                $preparacija_unosa->bindParam(":first_name", $first_name);
                $preparacija_unosa->bindParam(":last_name", $last_name);
                $preparacija_unosa->bindParam(":email", $email);
                $preparacija_unosa->bindParam(":password", $kriptovana_sifra);
                $preparacija_unosa->bindParam(":picture", $picture);
                $preparacija_unosa->bindParam(":role_id", $role_id);
                $preparacija_unosa->bindParam(":banned", $banned);

                $izvrsavanje = $preparacija_unosa->execute();

                if ($izvrsavanje) {
                    $odgovor = ["poruka" => "You have successfully registered"];
                    $code = ["code" => 201];
                } else {
                    $odgovor = ["poruka" => "Database problem. Try again"];
                    $code = ["code" => 503];
                }
            }
        } else {
            $odgovor = ["poruka" => "Something is incorrect. Check your data"];
            $code = ["code" => 422];
        }
    } else {
        $code = ["code" => 503];
    }
}

$ajaxResponse = json_encode($code);
echo $ajaxResponse;
?>
