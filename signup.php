<?php session_start(); ?>
<h2>Signup</h2>
<form action="includes/signup.inc.php" method="POST">
    <input type="text" name="firstname" id="" placeholder="Firstname" autocomplete="off">
    <input type="text" name="lastname" id="" placeholder="Lastname" autocomplete="off">
    <input type="text" name="email" id="" placeholder="E-mail" autocomplete="off">
    <input type="text" name="uid" id="" placeholder="Username" autocomplete="off">
    <input type="password" name="pwd" id="" placeholder="password" autocomplete="off">
    <button type="submit" name="submit">Sign up</button>
</form