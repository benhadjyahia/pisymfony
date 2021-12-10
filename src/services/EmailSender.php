<?php


namespace App\services;


use App\Entity\EmailModel;
use App\Entity\User;
use Mailjet\Client;
use Mailjet\Resources;

class EmailSender{


    public function sendEmailByMailJet(User $user, EmailModel $email){

        $mj = new Client('9c07a6d8dbb570bfe09f3fafd7b1dcca', '2fd452e57e586b8805ff84bd956ac1a6',true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "mohamedmalek.saidi@esprit.tn",
                        'Name' => "Totalfitness contact"
                    ],
                    'To' => [
                        [
                            'Email' => $user->getEmail(),
                            'Name' => ''
                            //'Name' => $user->getNom()
                        ]
                    ],
                    'TemplateID' => 3396455,
                    'TemplateLanguage' => true,
                    'Subject' => $email->getSubject(),
                    'Variables' =>[
                        'title' => $email->getTitle(),
                        'content' => $email->getContent()
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && ($response->getData());



    }

}