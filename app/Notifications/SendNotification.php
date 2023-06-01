<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class SendNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Order $order)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toTelegram($notifiable)
    {
        $options = $this->order->options()->get();

        $optionStrings = [];
        foreach ($options as $option) {
            $optionStrings[] = $option->displayName() . ': ' . $option->name;
        }

        $optionList = implode(', ', $optionStrings);

        if ($this->order->options()->get()!="[]"){
            return TelegramMessage::create()
            ->to('-1001927227945')
            ->line('Нове замовлення!')
            ->line('Користувач ' . $this->order->user->name . ' залишив замовлення на ' . $this->order->car->make . ' ' . $this->order->car->model)
            ->line('Сума замовлення склала: ' . $this->order->total_price.'$')
            ->line('Додані опції: '.$optionList);
        }               
        else{
            return TelegramMessage::create()
            ->to('-1001927227945')
            ->line('Нове замовлення!')
            ->line('Користувач ' . $this->order->user->name . ' залишив замовлення на ' . $this->order->car->make . ' ' . $this->order->car->model)
            ->line('Сума замовлення склала: ' . $this->order->total_price.'$');
            
        }

        
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
