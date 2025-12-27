<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuizResultMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $result;
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->result->status == 'pass' 
                ? 'Chúc mừng! Bạn đã hoàn thành khóa học' 
                : 'Thông báo kết quả bài thi cuối kỳ',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.emails.quiz_result',
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

        if ($this->result->status == 'pass') {
            
            $data = [
                'user' => $this->result->user,
                'course' => $this->result->quiz->course,
                'date' => now()->format('d/m/Y')
            ];

            
            $pdf = Pdf::loadView('emails.certificate_pdf', $data)
                      ->setPaper('a4', 'landscape')
                      ->setOptions(['defaultFont' => 'DejaVu Sans']);

            
            $attachments[] = Attachment::fromData(fn () => $pdf->output(), 'Chung-chi-hoan-thanh.pdf')
                                ->withMime('application/pdf');
        }

        return $attachments;
    }
}
