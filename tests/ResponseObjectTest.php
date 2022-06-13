<?php

declare(strict_types=1);

namespace Tests;

use JsendStandard\Factory\ResponseFactory;
use JsendStandard\ValueObject\ResponseBodyObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseObjectTest extends TestCase
{
    public function testSuccessResponseObject(): void
    {
        $responseFactory = new ResponseFactory();
        $responseBodyObject = new ResponseBodyObject(ResponseBodyObject::STATUS_SUCCESS, ['foo'], 200);
        $response = $responseFactory->createJsonResponse($responseBodyObject);

        $sameResponse = new JsonResponse([
            'data' => [
                'foo',
            ],
            'status' => 'success',
        ]);

        $this->assertSame(\strval($sameResponse), \strval($response));
    }

    public function testFailResponseObject(): void
    {
        $responseFactory = new ResponseFactory();
        $data = [];
        $message = JsonResponse::$statusTexts[400];
        $httpCode = 400;
        $status = ResponseBodyObject::STATUS_FAIL;
        $responseBodyObject = new ResponseBodyObject($status, $data, $httpCode, $message);
        $response = $responseFactory->createJsonResponse($responseBodyObject);

        $sameResponse = new JsonResponse([
            'message' => JsonResponse::$statusTexts[400],
            'status' => 'fail',
            'code' => 400,
        ], 400);

        $this->assertSame(\strval($sameResponse), \strval($response));
    }

    public function testErrorResponseObject(): void
    {
        $responseFactory = new ResponseFactory();
        $data = [];
        $message = JsonResponse::$statusTexts[500];
        $httpCode = 500;
        $status = ResponseBodyObject::STATUS_ERROR;
        $responseBodyObject = new ResponseBodyObject($status, $data, $httpCode, $message);
        $response = $responseFactory->createJsonResponse($responseBodyObject);

        $sameResponse = new JsonResponse([
            'message' => JsonResponse::$statusTexts[500],
            'status' => 'error',
            'code' => 500,
        ], 500);

        $this->assertSame(\strval($sameResponse), \strval($response));
    }
}
