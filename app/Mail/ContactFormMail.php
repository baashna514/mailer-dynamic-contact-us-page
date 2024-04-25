<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->data['email'], $this->data['name']),
            subject: 'Thank You For Contact Us!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.index',
            with: ([
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'phone' => $this->data['phone'],
                'content' => $this->data['message'],
            ])
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        // Check if attachments are present in the data
        if (isset($this->data['attachments']) && is_array($this->data['attachments'])) {
            // Loop through each attachment
            foreach ($this->data['attachments'] as $attachment) {
                // Check if the attachment is an instance of UploadedFile
                if ($attachment instanceof \Illuminate\Http\UploadedFile) {
                    // Generate a unique filename for each attachment
                    $filename = uniqid('attachment_') . '.' . $attachment->getClientOriginalExtension();

                    // Store the attachment in a temporary directory
                    $attachment->storeAs('temp', $filename);

                    // Attach the file to the email
                    $attachments[] = Attachment::fromPath(Storage::path('temp/' . $filename));
                }
            }
        }
        return $attachments;
    }
}
