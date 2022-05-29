<?php

declare(strict_types=1);

namespace JsendStandard\ValueObject;

use JsendStandard\Exception\JsendStandardException;

/**
 * @author tcloud <tcloud.ax@gmail.com>
 * @since  v1.0.0
 */
final class ResponseBodyObject
{
    public const STATUS_SUCCESS = 'success'; // All went well, and (usually) some data was returned.
    public const STATUS_FAIL    = 'fail';    // There was a problem with the data submitted, or
                                             // some pre-condition of the API call wasn't satisfied
    public const STATUS_ERROR   = 'error';   // An error occurred in processing the request, i.e. an
                                             // exception was thrown.

    private array $data;
    private string $status;
    private int $code;
    private ?string $message;

    /**
     * @param string      $status
     * @param array       $data
     * @param int         $code
     * @param string|null $message
     */
    public function __construct(string $status, array $data = [], int $code = 200, ?string $message = null)
    {
        $statuses = [self::STATUS_ERROR, self::STATUS_FAIL, self::STATUS_SUCCESS];
        if (!in_array($status, $statuses, true)) {
            throw new JsendStandardException(sprintf('Unsupported "status" value %s', $status));
        }
        $this->data    = $data;
        $this->status  = $status;
        $this->code    = $code;
        $this->message = $message;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
}