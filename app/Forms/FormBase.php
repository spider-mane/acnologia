<?php

namespace App\Forms;

use Psr\Http\Message\ServerRequestInterface;
use WebTheory\Saveyour\Contracts\FormValidatorInterface;
use WebTheory\Saveyour\Fields\Hidden;
use WebTheory\Saveyour\Validators\ReCaptcha3Validator;
use WebTheory\Zeref\Accessors\Config;
use WebTheory\Zeref\Contracts\FormInterface;
use WebTheory\Zeref\Forms\AbstractFormHandler;

abstract class FormBase extends AbstractFormHandler implements FormInterface
{
    /**
     *
     */
    public function verificationFields(ServerRequestInterface $request): array
    {
        $recaptcha = $this->config['recaptcha'];

        return array_merge(parent::verificationFields($request), [
            'recaptcha' => (new Hidden)
                ->setName($recaptcha)
                ->setId($recaptcha)
                ->toHtml()
        ]);
    }

    /**
     *
     */
    protected function formRequestValidators(): array
    {
        return array_merge(parent::formRequestValidators(), [
            'recaptcha' => $this->reCaptchaValidator()
        ]);
    }

    /**
     *
     */
    protected function reCaptchaValidator(): FormValidatorInterface
    {
        return new ReCaptcha3Validator(
            $this->config['recaptcha'],
            Config::get('services.recaptcha.secret')
        );
    }
}
