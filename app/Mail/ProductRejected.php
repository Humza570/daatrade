<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Product;
class ProductRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $reason;

    public function __construct(Product $product, $reason)
    {
        $this->product = $product;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->view('emails.product_rejected')
            ->subject('Product Rejection Notification');
    }
}
