<?php

namespace App\Mail;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMenu extends Mailable
{
    private $menu;
    private $restaurant;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Menu $menu, $toEmail, Array $emails)
    {
        $pdf = $menu->getPdf()->Output('poledni_menu.pdf', 'S');
        $this->attachData($pdf, 'poledni_menu.pdf', ['mime' => 'application/pdf']);
        $this->menu = $menu;
        $this->restaurant = Restaurant::find($menu->restaurant);
        $this->subject = "Polední menu - ".$this->restaurant->name;
        $this->from('zamek.dobris@seznam.cz', $this->restaurant->name);
        $this->to($toEmail);
        $this->bcc($emails);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.menu', ['menu' => $this->menu, 'restaurant' => $this->restaurant]);
    }
}
