<?php


namespace App\Services;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;


class MakeMailer extends AbstractController
{


    /**
     * @param String $from
     * @param String $to
     * @param String $subject
     * @param String $template
     * @param array $context
     * @param MailerInterface $mailer
     * @throws TransportExceptionInterface
     */
    static public function sendMail(String $from, String $to, String $subject, String $template, Array $context, MailerInterface $mailer)
    {
        $email = (new TemplatedEmail())
                ->from($from)
                ->to($to)
                ->subject($subject)
                ->htmlTemplate($template)
                ->context($context);

        $mailer->send($email);
    }

    /**
     * @param String $from
     * @param array $to
     * @param String $subject
     * @param String $template
     * @param array $context
     * @param MailerInterface $mailer
     * @throws TransportExceptionInterface
     */
    static public function sendMultiMails(String $from, Array $to, String $subject, String $template, Array $context, MailerInterface $mailer)
    {
        $email = (new TemplatedEmail())
                ->from($from)
                ->to($to[0])
                ->subject($subject)
                ->htmlTemplate($template)
                ->context($context);
        for($i = 1; $i < count($to) - 1; $i++){
            $email->addTo($to[$i]);
        }

        $mailer->send($email);
    }
}


















