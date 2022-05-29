<?php

declare(strict_types=1);

namespace JsendStandard;

use JsendStandard\DependencyInjection\JsendStandardExtension;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author tcloud <tcloud.ax@gmail.com>
 * @since  v1.0.0
 */
class JsendStandardBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function getContainerExtension(): Extension
    {
        return new JsendStandardExtension();
    }
}
