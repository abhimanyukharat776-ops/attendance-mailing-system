<?php
$conn = new mysqli("localhost", "root", "", "smart_project");
if ($conn->connect_error) {
    die("Connection failed");
}
