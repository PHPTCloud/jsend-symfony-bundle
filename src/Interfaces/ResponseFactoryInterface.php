<?php

declare(strict_types=1);

namespace JsendStandard\Interfaces;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author tcloud <tcloud.ax@gmail.com>
 * @since  v1.1.0
 */
interface ResponseFactoryInterface
{
    /**
     * @param string                      $type
     * @param ResponseBodyObjectInterface $body
     *
     * @return Response
     */
    public function createResponse(string $type, ResponseBodyObjectInterface $body): Response;

    /**
     * @param ResponseBodyObjectInterface $body
     *
     * @return JsonResponse
     */
    public function createJsonResponse(ResponseBodyObjectInterface $body): Response;

    /**
     * @param ResponseBodyObjectInterface $body
     *
     * @return Response
     */
    public function createDefaultResponse(ResponseBodyObjectInterface $body): Response;

    /**
     * @param ResponseBodyObjectInterface $body
     *
     * @return array
     */
    public function buildResponseBody(ResponseBodyObjectInterface $body): array;
}
