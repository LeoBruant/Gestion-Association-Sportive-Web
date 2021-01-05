<?php

namespace App\MessageHandler;

use App\Message\ForgotPasswordMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ForgotPasswordMessageHandler implements MessageHandlerInterface
{
    public function __invoke(ForgotPasswordMessage $message)
    {
        // do something with your message
    }
}
