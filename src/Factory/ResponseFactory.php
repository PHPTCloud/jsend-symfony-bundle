<?php

declare(strict_types=1);

namespace JsendStandard\Factory;

use JsendStandard\Exception\UnexpectedResponseTypeException;
use JsendStandard\Interfaces\ResponseBodyObjectInterface;
use JsendStandard\Interfaces\ResponseFactoryInterface;
use JsendStandard\ValueObject\ResponseBodyObject;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author tcloud <tcloud.ax@gmail.com>
 * @since  v1.1.0
 */
class ResponseFactory implements ResponseFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createResponse(string $type, ResponseBodyObjectInterface $body): Response
    {
        switch ($type) {
            case JsonResponse::class:
                return $this->createJsonResponse($body);
            case Response::class:
                return $this->createDefaultResponse($body);
            default:
                throw new UnexpectedResponseTypeException();
        }
    }

    /**
     * @inheritDoc
     */
    public function createJsonResponse(ResponseBodyObjectInterface $body): Response
    {
        $responseBody = $this->buildResponseBody($body);

        return new JsonResponse($responseBody, $body->getCode());
    }

    /**
     * @inheritDoc
     */
    public function createDefaultResponse(ResponseBodyObjectInterface $body): Response
    {
        $responseBody = $this->buildResponseBody($body);

        // @todo feature: create plain text in response
        return new Response(json_encode($responseBody), $body->getCode());
    }

    /**
     * @inheritDoc
     */
    public function buildResponseBody(ResponseBodyObjectInterface $body): array
    {
        if (ResponseBodyObject::STATUS_SUCCESS === $body->getStatus()) {
            $responseBody = [
                'status' => $body->getStatus(),
                'data'   => $body->getData(),
            ];
        } elseif (ResponseBodyObject::STATUS_FAIL === $body->getStatus()) {
            $responseBody = [
                'status'  => $body->getStatus(),
                'message' => $body->getMessage(),
                'data'    => $body->getData(),
            ];
        } else {
            $responseBody = [
                'status'  => $body->getStatus(),
                'message' => $body->getMessage(),
            ];
        }

        return $responseBody;
    }
}
