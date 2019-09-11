<?php
require_once('PantryDatabase.php');
require_once('Mail.php');

/**
 * The class for the notification sender
 */
class Sender {
    // TODO: Change this to config.
    const HOST = 'ssl://smtp.gmail.com';
    const PORT = '465';
    const USERNAME = 'CIS234A@gmail.com';
    const PASSWORD = 'CIS234A_mail';
    const FROM = 'PCC Pantry <pantry@pcc.edu>';

    
    public static function sendNotification($message) {
        $db = new PantryDatabase();
        $subscribers = $db->getSubscribers();

        $subject = 'PCC Pantry: Restock Update';

        foreach ($subscribers as $subscriber) {
            $headers = ['To' => $subscriber['email'],
                'From' => Sender::FROM,
                'Subject' => $subject,
                'MIME-VERSION' => 1.0,
                'Content-Type' => 'text/html; charset=utf-8'];
            $transport = ['host' => Sender::HOST,
                'port' => Sender::PORT,
                'username' => Sender::USERNAME,
                'password' => Sender::PASSWORD,
                'auth' => TRUE];
            $smtp = Mail::factory('smtp', $transport);
            $smtp->send($headers['To'], $headers, $message);
        }
        date_default_timezone_set('America/Los_Angeles');
        $db->addLog($_SESSION['user_id'], $message, date('Y/m/d G:i'), (string) count($subscribers));
        header('Location: ../../send_notification.php');
    }
}
