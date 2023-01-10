<?php

namespace App\Adapter;

class BlogPostPublisher{
    public $wp;
    public function __construct(WordPressInterface $wp)
    {
        $this->wp = $wp;
    }
    public function addBlogPost($title, $post_body)
    {
        // (This is just a silly example. WordPress doesn't work like this, you can just use the XML-RPC protocol to do it in one request.
        $this->wp->login();
        $this->wp->setToMaintenanceMode(); // again, not a thing to do in WP but just for this example<br>
        $this->wp->post($title, $post_body);
        // done!
    }
}

interface WordPressInterface
{
    public function login();
    public function setToMaintenanceMode();
    public function post($title, $post_body);
}
class WordPressPublisher implements WordPressInterface
{
    private $loginCredentials;
    public function login()
    {
        // login with WP
        $this->loginCredentials = SomeWPLibrary::login('user', 'pass');
    }
    public function setToMaintenanceMode()
    {
        SomeWPLibrary::setToMaintenanceMode($this->loginCredentials);
    }
    public function post($title, $post_body)
    {
        // and finally send the actual post to the blog
        // this should return the HTML of the blog post
        return SomeWPLibrary::post($this->loginCredentials, $title, $post_body);
    }
}
$poster = new BlogPostPublisher(new WordPressPublisher());
$poster->addBlogPost("Hello, world", "Welcome to my blog post");

