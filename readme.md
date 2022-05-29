# Symfony jsend bundle

Implementation of [jsend](https://github.com/omniti-labs/jsend) specification for http responses

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
    ResponseBodyObject::STATUS_ERROR,
    [],
    400,
    'validation error'
));
```

```php
$responseFactory->createJsonResponse(new ResponseBodyObject(
    ResponseBodyObject::STATUS_FAIL,
    [],
    500
));
```