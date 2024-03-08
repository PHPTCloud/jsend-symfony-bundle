<?php

declare(strict_types=1);

namespace PHPTCloud\JsendStandard\Interfaces;

/**
 * @author tcloud <tcloud.ax@gmail.com>
 * @since  v1.1.0
 */
interface ResponseBodyObjectInterface
{
    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @return string|null
     */
    public function getMessage(): ?string;
}
