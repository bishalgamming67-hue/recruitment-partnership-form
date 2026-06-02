<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

function clean($data)
{
    return htmlspecialchars(strip_tags(trim($data ?? '')));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}

$company_name = clean($_POST['company_name'] ?? '');
$country = clean($_POST['country'] ?? '');
$address = clean($_POST['address'] ?? '');
$website = clean($_POST['website'] ?? '');
$year_established = clean($_POST['year_established'] ?? '');
$employees = clean($_POST['employees'] ?? '');

$fullname = clean($_POST['fullname'] ?? '');
$job_title = clean($_POST['job_title'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$phone = clean($_POST['phone'] ?? '');

$license_number = clean($_POST['license_number'] ?? '');
$experience_years = clean($_POST['experience_years'] ?? '');
$industries = clean($_POST['industries'] ?? '');
$recruitment_countries = clean($_POST['recruitment_countries'] ?? '');

$services = clean($_POST['services'] ?? '');
$markets = clean($_POST['markets'] ?? '');
$objectives = clean($_POST['objectives'] ?? '');

$candidate_capacity = clean($_POST['candidate_capacity'] ?? '');
$database_size = clean($_POST['database_size'] ?? '');

$visa_support = clean($_POST['visa_support'] ?? '');
$skill_testing = clean($_POST['skill_testing'] ?? '');

$compliance = clean($_POST['compliance'] ?? '');

if (!$email) {
    die('Invalid email address');
}

$partnership = isset($_POST['partnership'])
    ? implode(', ', (array)$_POST['partnership'])
    : 'Not selected';

$workforce = isset($_POST['workforce'])
    ? implode(', ', (array)$_POST['workforce'])
    : 'Not selected';

$message = "
==================== B2B PARTNERSHIP FORM ====================

COMPANY INFO
Company: $company_name
Country: $country
Address: $address
Website: $website
Year Established: $year_established
Employees: $employees

CONTACT
Name: $fullname
Job Title: $job_title
Email: $email
Phone: $phone

RECRUITMENT
License Number: $license_number
Experience Years: $experience_years
Industries: $industries
Recruitment Countries: $recruitment_countries

PARTNERSHIP
$partnership

WORKFORCE
$workforce

BUSINESS
Services: $services
Markets: $markets
Objectives: $objectives

CAPACITY
Candidate Capacity: $candidate_capacity
Database Size: $database_size
Visa Support: $visa_support
Skill Testing: $skill_testing

COMPLIANCE
$compliance

========================================================
Worldwide Recruitment Services
https://wrsnepal.com
========================================================
";

$mail = new PHPMailer(true);

$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'bishalgamming67@gmail.com';
    $mail->Password = 'lkvhvfmcckkvmmqm';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom(
        'bishalgamming67@gmail.com',
        'Worldwide Recruitment Services'
    );

    $mail->addAddress('wrsnepal@gmail.com');
    $mail->addReplyTo($email, $fullname);

    $mail->isHTML(false);
    $mail->CharSet = 'UTF-8';

    $mail->Subject = 'New B2B Partnership Request';
    $mail->Body = $message;

    $mail->send();

    header('Location: thankyou.html');
    exit();

} catch (Exception $e) {

    echo 'Mailer Error: ' . $mail->ErrorInfo;
}