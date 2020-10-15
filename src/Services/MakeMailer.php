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
}