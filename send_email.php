<?php
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
require __DIR__ . '/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$data = json_decode(file_get_contents("php://input"), true);

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;

$mail->Username = 'youremail@gmail.com';
$mail->Password = 'yourpassword';

$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('youremail@gmail.com', 'Attendance System');

date_default_timezone_set("Asia/Kolkata");

$timetable = [
    "Monday" => [
        "Maths" => "01:45 PM - 02:45 PM",
        "Workshop" => "03:00 PM - 05:00 PM"
    ],

    "Tuesday" => [
        "WDL" => "10:00 AM - 12:00 PM",
        "EME" => "12:45 PM - 01:45 PM",
        "Physics" => "01:45 PM - 02:45 PM",
        "Workshop" => "03:00 PM - 05:00 PM"
    ],

    "Wednesday" => [
        "Chemistry" => "10:00 AM - 12:00 PM",
        "UHV" => "12:45 PM - 01:45 PM",
        "EME" => "01:45 PM - 02:45 PM"
    ],

    "Thursday" => [
        "Maths" => "11:00 AM - 12:00 PM",
        "Chemistry" => "12:45 PM - 01:45 PM",
        "Physics" => "01:45 PM - 02:45 PM"
    ],

    "Friday" => [
        "UHV" => "10:00 AM - 11:00 AM",
        "Chemistry" => "11:00 AM - 12:00 PM",
        "Workshop" => "12:45 PM - 02:45 PM",
        "Physics" => "03:00 PM - 05:00 PM"
    ],

    "Saturday" => [
        "Maths" => "10:00 AM - 11:00 AM",
        "Physics" => "11:00 AM - 12:00 PM"
    ]
];

foreach ($data as $s) {

    $date = date("d M Y");
    $time = date("h:i A");
    $today = date("l");

    $subjectName = $s['subject'];

    $lectureTime = isset($timetable[$today][$subjectName])
        ? $timetable[$today][$subjectName]
        : "No Lecture Today";

    $mail->addAddress($s['email']);

    $mail->isHTML(true);
    $mail->Subject = "Attendance Alert";

    $message = "Dear {$s['name']},
You were ABSENT in {$subjectName}
Day: {$today}
Lecture Time: {$lectureTime}
Marked at: {$time}";

    // Convert line breaks to HTML
    $mail->Body = nl2br($message);

    $mail->send();
    $mail->clearAddresses();
}

echo "Email Sent Successfully ✅";
?>