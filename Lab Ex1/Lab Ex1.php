<?php
session_start();

/* 1. Set "username" Cookie (1 hour) */
if (isset($_GET['set_cookie'])) {
    setcookie("username", "Gulnara Serik", time() + 3600, "/");
    echo "1. Cookie 'username' set<br>";
}

/* 2. Retrieve "username" Cookie */
if (isset($_GET['get_cookie'])) {
    echo "2. Username Cookie: " . ($_COOKIE["username"] ?? "Not set") . "<br>";
}

/* 3. Delete "username" Cookie */
if (isset($_GET['delete_cookie'])) {
    setcookie("username", "", time() - 3600, "/");
    echo "3. Cookie 'username' deleted<br>";
}

/* 4. Set "userid" Session */
if (isset($_GET['set_session'])) {
    $_SESSION["userid"] = 10020;
    echo "4. Session 'userid' set<br>";
}

/* 5. Retrieve "userid" Session */
if (isset($_GET['get_session'])) {
    echo "5. UserID Session: " . ($_SESSION["userid"] ?? "Not set") . "<br>";
}

/* 6. Destroy Session */
if (isset($_GET['destroy_session'])) {
    session_unset();
    session_destroy();
    echo "6. Session destroyed<br>";
}

/* 7. Secure Cookie */
if (isset($_GET['secure_cookie'])) {
    setcookie("secure_cookie", "secure", time() + 3600, "/", "", true, true);
    echo "7. Secure cookie set (HTTPS only)<br>";
}

/* 8. Check "visited" Cookie */
if (!isset($_COOKIE["visited"])) {
    setcookie("visited", "yes", time() + 3600, "/");
    echo "8. Welcome, first-time visitor<br>";
} else {
    echo "8. Welcome back!<br>";
}

/* 9. Store Array in Session */
if (isset($_GET['set_pref'])) {
    $_SESSION["preferences"] = [
        "theme" => "dark",
        "language" => "English",
        "notifications" => true
    ];
    echo "9. Preferences stored<br>";
}

/* 10. Retrieve Preferences */
if (isset($_GET['get_pref'])) {
    echo "10. Preferences:<pre>";
    print_r($_SESSION["preferences"] ?? []);
    echo "</pre>";
}

/* 11. Session Timeout */
$timeout = 1800;
if (isset($_SESSION["LAST_ACTIVITY"]) &&
    (time() - $_SESSION["LAST_ACTIVITY"]) > $timeout) {
    session_unset();
    session_destroy();
    echo "11. Session expired<br>";
}
$_SESSION["LAST_ACTIVITY"] = time();

/* 12. Active Sessions */
$file = "sessions.txt";
$count = file_exists($file) ? (int)file_get_contents($file) : 0;
if (!isset($_SESSION["counted"])) {
    $count++;
    file_put_contents($file, $count);
    $_SESSION["counted"] = true;
}
echo "12. Active sessions: $count<br>";

/* 13. Limit Concurrent Sessions  */
$fileUser = "user_sessions.txt";
$sessions = file_exists($fileUser) ? json_decode(file_get_contents($fileUser), true) : [];
$sessions = array_filter($sessions, fn($t) => $t > time() - 1800);
if (count($sessions) < 3) {
    $sessions[] = time();
    file_put_contents($fileUser, json_encode($sessions));
    echo "13. Session allowed<br>";
} else {
    echo "13. Maximum sessions reached<br>";
}

/* 14. Regenerate Session ID */
if (isset($_GET['regen'])) {
    session_regenerate_id(true);
    echo "14. Session ID regenerated<br>";
}

/* 15. Last Access Time */
if (isset($_SESSION["LAST_ACCESS"])) {
    echo "15. Last access: " . date("Y-m-d H:i:s", $_SESSION["LAST_ACCESS"]) . "<br>";
}
$_SESSION["LAST_ACCESS"] = time();

/* 16. Cookie & Session Same Name */
setcookie("user", "CookieUser", time() + 3600, "/");
$_SESSION["user"] = "SessionUser";

echo "16. Cookie user: " . ($_COOKIE["user"] ?? "Not set") . "<br>";
echo "16. Session user: " . $_SESSION["user"] . "<br>";
?>

