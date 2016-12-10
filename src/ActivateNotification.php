<?php

namespace Takachaa\Tauth;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * ActivateNotification class is notification for activating account by email.
 * It is used by the 'sendActivationNotification' method of 'PreUser' class.
 */
class ActivateNotification extends Notification
{
	/**
	 * The activate account token.
	 *
	 * @var string
	 */
	public $token;

	/**
	 * Create a notification instance.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function __construct($token)
	{
		$this->token = $token;
	}

	/**
	 * Get the notification's channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array|string
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Build the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->subject('Activate your account')
			->greeting('Hi ' . $notifiable->name . '.')
			->line('Thank you for registering our service.')
			->line('You are received this email because you need to activate your account in an hour.')
			->line('Please click under the button to activate your account.')
			->action('Activate Account', url('activate', $this->token));
	}
}
