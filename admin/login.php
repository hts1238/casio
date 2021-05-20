<?php

const PASS = "uUYNawBjI7bSzQFcQpromkiUE";

if (!isset($_POST["pass"])) {
    include_once("header.html");

    echo '<main><form action="./login.php" method="POST"><input type="password" name="pass" placeholder="Password"><input type="submit"></form></main>';

    include_once("footer.html");
    exit(0);
}

if ($_POST["pass"] == PASS) {
	setcookie('pass', $_POST["pass"], time() + 3000000, '/');
}

header("Location: ./");