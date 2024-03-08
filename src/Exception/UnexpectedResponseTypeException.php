<?php

declare(strict_types=1);

namespace PHPTCloud\JsendStandard\Exception;

/**
 * @author tcloud <tcloud.ax@gmail.com>
 * @since  v1.1.0
 */
class UnexpectedResponseTypeException extends JsendStandardException
{
    protected $message = 'Unexpected response type.';
}
