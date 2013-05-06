<?php
/**
 * This file is part of the ImboClient package
 *
 * (c) Christer Edvartsen <cogo@starzinger.net>
 *
 * For the full copyright and license information, please view the LICENSE file that was
 * distributed with this source code.
 */

return array(
    'name' => 'Imbo',
    'apiVersion' => '',
    'description' => 'Imbo has an API that allows you to add/remove images and metadata. The API also supports dynamically transforming images without storing all variants',

    // API operations
    'operations' => array(
        // Status
        'GetServerStatus' => array(
            'httpMethod' => 'GET',
            'uri' => '/status.json',
            'summary' => 'Get status about the Imbo host',
            'responseClass' => 'GetServerStatusOutput',
        ),

        // User
        'GetUserInfo' => array(
            'httpMethod' => 'GET',
            'uri' => '/users/{publicKey}',
            'summary' => 'Get information about a specific user',
            'parameters' => array(
                'publicKey' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'uri',
                    'description' => 'The public key of the user we want information about',
                ),
            ),
            'responseClass' => 'UserInfoOutput',
        ),

        // Image
        'AddImage' => array(
            'httpMethod' => 'PUT',
            'uri' => '/users/{publicKey}/images/{imageIdentifier}',
            'summary' => 'Add an image',
            'parameters' => array(
                'image' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'body',
                    'description' => 'The binary data of the image to add',
                ),
                'signature' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Signature',
                    'description' => 'The signature needed to execute write operations',
                ),
                'timestamp' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Timestamp',
                    'description' => 'The timestamp used when generating the signature',
                ),
            ),
        ),
        'DeleteImage' => array(
            'httpMethod' => 'DELETE',
            'uri' => '/users/{publicKey}/images/{imageIdentifier}',
            'summary' => 'Delete an image',
            'parameters' => array(
                'signature' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Signature',
                    'description' => 'The signature needed to execute write operations',
                ),
                'timestamp' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Timestamp',
                    'description' => 'The timestamp used when generating the signature',
                ),
            ),
        ),
        'TransformImage' => array(
            'httpMethod' => 'GET',
            'uri' => '/users/{publicKey}/images/{imageIdentifier}',
            'summary' => 'Transform an existing image',
            'parameters' => array(
                'accessToken' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'query',
                    'description' => 'Access token needed to fetch data',
                    'pattern' => '/^[a-f0-9]{32}$/',
                ),
            ),
        ),

        // Images
        'GetImages' => array(
            'httpMethod' => 'GET',
            'uri' => '/users/{publicKey}/images',
            'summary' => 'Query images',
            'parameters' => array(
                'accessToken' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'query',
                    'description' => 'Access token needed to fetch data',
                    'pattern' => '/^[a-f0-9]{32}$/',
                ),
            ),
        ),

        // Metadata
        'GetMetadata' => array(
            'httpMethod' => 'GET',
            'uri' => '/users/{publicKey}/images/{imageIdentifier}/metadata',
            'summary' => 'Get metadata attached to an image',
            'parameters' => array(
                'accessToken' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'query',
                    'description' => 'Access token needed to fetch data',
                    'pattern' => '/^[a-f0-9]{32}$/',
                ),
            ),
        ),
        'ReplaceMetadata' => array(
            'httpMethod' => 'PUT',
            'uri' => '/users/{publicKey}/images/{imageIdentifier}/metadata',
            'summary' => 'Completely replace the metadata attached to an image with new metadata',
            'parameters' => array(
                'signature' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Signature',
                    'description' => 'The signature needed to execute write operations',
                ),
                'timestamp' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Timestamp',
                    'description' => 'The timestamp used when generating the signature',
                ),
            ),
        ),
        'EditMetadata' => array(
            'httpMethod' => 'POST',
            'uri' => '/users/{publicKey}/images/{imageIdentifier}/metadata',
            'summary' => 'Update metadata attached to an image. Supports partial updates',
            'parameters' => array(
                'signature' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Signature',
                    'description' => 'The signature needed to execute write operations',
                ),
                'timestamp' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Timestamp',
                    'description' => 'The timestamp used when generating the signature',
                ),
            ),
        ),
        'DeleteMetadata' => array(
            'httpMethod' => 'DELETE',
            'uri' => '/users/{publicKey}/images/{imageIdentifier}/metadata',
            'summary' => 'Delete metadata attached to an image',
            'parameters' => array(
                'signature' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Signature',
                    'description' => 'The signature needed to execute write operations',
                ),
                'timestamp' => array(
                    'type' => 'string',
                    'required' => true,
                    'location' => 'header',
                    'sentAs' => 'X-Imbo-Authenticate-Timestamp',
                    'description' => 'The timestamp used when generating the signature',
                ),
            ),
        ),
    ),

    // Models for the API response
    'models' => array(
        'GetServerStatusOutput' => array(
            'type' => 'array',
            'properties' => array(
                'database' => array(
                    'type' => 'boolean',
                    'location' => 'json',
                ),
                'storage' => array(
                    'type' => 'boolean',
                    'location' => 'json',
                ),
                'date' => array(
                    'type' => 'string',
                    'location' => 'json',
                ),
            ),
        ),
        'UserInfoOutput' => array(
            'type' => 'array',
            'properties' => array(
                'publicKey' => array(
                    'type' => 'string',
                    'location' => 'json',
                ),
                'numImages' => array(
                    'type' => 'integer',
                    'location' => 'json',
                ),
                'lastModified' => array(
                    'type' => 'string',
                    'location' => 'json',
                ),
            ),
        ),
    ),
);
