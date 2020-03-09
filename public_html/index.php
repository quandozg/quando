<html>
<head>
</head>
<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../code/app/bootstrap.php';

use App\Forms\AbstractForm;
use App\Forms\SubscribeForm;
use App\Services\Email\EmailInterface;

$services = getServices();
$form = new SubscribeForm(isset($_POST['submit']) ? $_POST : []);

if (isset($_POST['submit'])) {
    $form = new SubscribeForm($_POST);
    if ($form->isValid()) {
        sendEmail($services, $form);
        exit;
    }
    $errors = $form->getErrors();
}
?>
<div>
    <form method="POST" id="subscriptionForm">
        <label for="firstName">First<?php
            echo $form->isRequiredField('firstName') ? '*' : '' ?>: </label>
        <input name="firstName" id="firstName" type="text" value="<?php echo $_POST['firstName'] ?? '' ?>" size="50"/><br/>
        <?php echo implode(' ', $errors['firstName'] ?? []); ?><br/>
        <label for="lastName">Last<?php
            echo $form->isRequiredField('lastName') ? '*' : '' ?>:</label>
        <input name="lastName" id="lastName" type="text" value="<?php echo $_POST['lastName'] ?? '' ?>" size="50"/><br/>
        <?php echo implode(' ', $errors['lastName'] ?? []); ?><br/>
        <label for="email">Email<?php
            echo $form->isRequiredField('email') ? '*' : '' ?>:</label>
        <input name="email" id="email" type="email" value="<?php echo $_POST['email'] ?? '' ?>" size="50"/><br/>
        <?php echo implode(' ', $errors['email'] ?? []); ?><br/>
        <input type="submit" name="submit">
    </form>
</div>
</html>
<?php
function sendEmail(array $services, AbstractForm $form)
{
    /** @var EmailInterface $emailService */
    $emailService = $services['emailService'];
    $dbService = $services['dbService'];
    $data = $form->getModel();
    $dbService->saveModel($data);
    $emailService->send('me@me.com', (string)$data->getField('email'), 'Registered', 'You have been registered.');
    echo "<html><head><body>Email sent. Welcome.</body></head></html>";
}
