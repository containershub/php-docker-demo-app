<?php declare(strict_types=1);

namespace App\Controllers;

use App\Classes\Mail;
use App\Models\Post;
use App\Models\User;

class IndexController
{

    private User $user;
    private Post $post;
    public array $data;

    public function __construct()
    {
        $this->user = new User;
        $this->post = new Post;
        $this->data = ['users' => $this->user->getAll(), 'posts' => $this->post->getAll()];
    }

    public function show(): void
    {
        echo view('../views/home', $this->data);
    }

    public function storeUser(): void
    {
        if (count($_POST) > 0) {
            $this->user->insertOne([
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email_address' => $_POST['email'],
            ]);
        }

        $this->data = ['users' => $this->user->getAll(), 'posts' => $this->post->getAll()];
        echo view('../views/home', $this->data);
    }
    
    public function storePost(): void
    {
        if (count($_POST) > 0) {
            $this->post->insertOne([
                'title' => $_POST['post_title'],
                'post' => $_POST['post_text'],
            ]);
        }

        $this->data = ['users' => $this->user->getAll(), 'posts' => $this->post->getAll()];
        echo view('../views/home', $this->data);
    }

    public function sendMail(): void
    {
        $data = [
            'to' => 'john@gmail.com',
            'name' => 'John Doe',
            'subject' => 'Test Email',
            'body' => 'This is a test email...'
        ];

        $mailer = new Mail;
        $mailer->send($data);
        
        echo view('../views/home', $this->data);
    }

}
