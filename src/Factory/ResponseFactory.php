<?php

declare(strict_types=1);

namespace JsendStandard\Factory;

use JsendStandard\ValueObject\ResponseBodyObject;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author tcloud <tcloud.ax@gmail.com>
 * @since  v1.0.0
 */
class ResponseFactory
{
    /**
     * @param ResponseBodyObject $responseBodyObject
     *
     * @return JsonResponse
     */
    public function createJsonResponse(ResponseBodyObject $responseBodyObject): JsonResponse
    {
        $status = $responseBodyObject->getStatus();
        if ($status === ResponseBodyObject::STATUS_SUCCESS) {
            return $this->createSuccessResponse($responseBodyObject);
        } else {
            return $this->createErrorResponse($responseBodyObject);
        }
    }

    /**
     * @param ResponseBodyObject $responseBodyObject
     *
     * @return JsonResponse
     */
    private function createErrorResponse(ResponseBodyObject $responseBodyObject): JsonResponse
    {
        if (null !== $responseBodyObject->getMessage()) {
            $body['message'] = $responseBodyObject->getMessage();
        }
        if (!empty($responseBodyObject->getData())) {
            $body['data'] = $responseBodyObject->getData();
        }
        $body     = [
            'status' => $responseBodyObject->getStatus(),
            'code'   => $responseBodyObject->getCode(),
        ];
        $response = new JsonResponse($body);
        $response->setStatusCode($responseBodyObject->getCode());

        return $response;
    }

    /**
     * @param ResponseBodyObject $responseBodyObject
     *
     * @return JsonResponse
     */
    private function createSuccessResponse(ResponseBodyObject $responseBodyObject): JsonResponse
    {
        $response = new JsonResponse([
            'data'   => $responseBodyObject->getData(),
            'status' => $responseBodyObject->getStatus(),
        ]);
        $response->setStatusCode($responseBodyObject->getCode());

        return $response;
    }
}
