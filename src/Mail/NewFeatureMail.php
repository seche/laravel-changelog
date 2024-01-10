<?php

namespace Seche\LaravelChangelog\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Seche\LaravelChangelog\Models\Changelog;

class NewFeatureMail extends Mailable
{
    use Queueable, SerializesModels;

    public $changelog;

    public function __construct(Changelog $changelog)
    {
        $this->changelog = $changelog;
    }

    public function build()
    {
        return $this->view('changelog::emails.new-feature');
    }
}
