# Symfony jsend bundle

![downloads](https://img.shields.io/badge/downloads-200%2B-orange) ![version](https://img.shields.io/badge/version-2.0.1-blue) ![tests](https://img.shields.io/badge/tests-yes-blue) ![docs](https://img.shields.io/badge/docs-yes-blue)  ![license](https://img.shields.io/badge/license-MIT-brightgreen) ![useful](https://img.shields.io/badge/Maintained%3F-yes-brightgreen)

Implementation of [jsend](https://github.com/omniti-labs/jsend) specification for http responses

# Install

```bash
composer require tcloud.ax/symfony-jsend-bundle
```

## Usage

```php
$responseFactory = new \JsendStandard\Factory\ResponseFactory();
// or use factory through symfony container ...
```

```php
$responseFactory->createJsonResponse(new ResponseBodyObject(ResponseBodyObject::STATUS_SUCCESS));
```

```php
$responseFactory->createJsonResponse(new ResponseBodyObject(
    ResponseBodyObject::STATUS_FAIL,
    [],
    400,
    'validation error'
));
```

```php
$responseFactory->createJsonResponse(new ResponseBodyObject(
    ResponseBodyObject::STATUS_ERROR,
    [],
    500,
    'Internal server error'
));
```