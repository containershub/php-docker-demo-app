<?php declare(strict_types=1);

namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{

    protected PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer;
        $this->setup();
    }

    public function setup(): void
    {
        $this->mail->isSMTP();
        $this->mail->Mailer = 'smtp';
        $this->mail->SMTPAuth = false;  // should be true in prod
        $this->mail->SMTPSecure = '';   // should be 'tls' in prod

        $this->mail->Host = 'mailpit';
        $this->mail->Port = 1025;

        $this->mail->From = "phpapp@mail.com";
        $this->mail->FromName = "PHPDemoApp";
    }

    /**
     * Sends the email
     *
     * @param array $data
     * @return bool
     */
    public function send(array $data): bool
    {
        $this->mail->addAddress($data['to'], $data['name']);
        $this->mail->Subject = $data['subject'];
        $this->mail->Body = $data['body'];

        return $this->mail->send();
    }

}
