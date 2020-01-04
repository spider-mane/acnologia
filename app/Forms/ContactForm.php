<?php

namespace App\Forms;

use Respect\Validation\Validator as v;
use Swift_Message;
use WebTheory\GuctilityBelt\Phone;
use WebTheory\Saveyour\Contracts\FormDataProcessorInterface;
use WebTheory\Saveyour\Controllers\FormFieldController;
use WebTheory\Saveyour\Processors\FormDataSwiftMailer;
use WebTheory\Zeref\Accessors\App;
use WebTheory\Zeref\Accessors\Config;
use WebTheory\Zeref\Contracts\FormInterface;

class ContactForm extends FormBase implements FormInterface
{
    /**
     *
     */
    protected function config(): array
    {
        $prefix = Config::get("app.key_prefix");

        return [

            'nonce' => [
                "name" => "{$prefix}-contact-nonce",
                "action" => "{$prefix}-contact-form"
            ],

            'recaptcha' => 'g-recaptcha-response',

            'fields' => [
                "full_name" => [
                    "name" => "{$prefix}-full-name",
                    "required" => true,
                ],
                "phone_number" => [
                    "name" => "{$prefix}-phone-number",
                    "required" => true
                ],
                "email_address" => [
                    "name" => "{$prefix}-email-address",
                    "required" => true
                ],
                "organization" => [
                    "name" => "{$prefix}-organization",
                    "required" => false
                ],
                "website" => [
                    "name" => "{$prefix}-current-website",
                    "required" => false
                ],
                "message" => [
                    "name" => "{$prefix}-message",
                    "required" => true
                ],
            ],

            'mailer' => [
                "mailto" => "email@domain.com",
                "subject" => "New Contact Requested"
            ],
        ];
    }

    /**
     *
     */
    protected function formFieldControllers(): array
    {
        $fields = $this->config['fields'];

        return [

            "full_name" => (new FormFieldController($fields["full_name"]["name"]))
                ->addFilter("sanitize_text_field"),

            "phone_number" => (new FormFieldController($fields["phone_number"]["name"]))
                ->addFilter([Phone::class, "formatUS"])
                ->addRule("valid_phone", v::phone(), "Please provide a valid phone number"),

            "email_address" => (new FormFieldController($fields["email_address"]["name"]))
                ->addFilter("sanitize_text_field")
                ->addRule("valid_email", v::email(), "Please provide a valid email address"),

            "organization" => (new FormFieldController($fields["organization"]["name"]))
                ->addFilter("sanitize_text_field"),

            "website" => (new FormFieldController($fields["website"]["name"]))
                ->addFilter("esc_url")
                ->addRule("valid_url", v::url(), "Please provide a valid website address"),

            "message" => (new FormFieldController($fields["message"]["name"]))
                ->addFilter("sanitize_textarea_field"),
        ];
    }

    /**
     *
     */
    protected function formDataProcessors(): array
    {
        return [
            "mailer" => $this->formDataMailer()
        ];
    }

    /**
     *
     */
    protected function formDataMailer(): FormDataProcessorInterface
    {
        $sender = Config::get("mail.from");
        $mailConfig = $this->config['mailer'];

        $message = (new Swift_Message($mailConfig["subject"]))
            ->setFrom($sender["address"], $sender["name"])
            ->setTo($mailConfig["mailto"]);

        $fields = array_map(function ($field) {
            return $field["name"];
        }, $this->config['fields']);

        return (new FormDataSwiftMailer(App::get("mailer"), $message))
            ->setFields($fields);
    }
}
