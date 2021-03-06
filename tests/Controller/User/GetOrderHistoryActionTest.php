<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusVueStorefrontPlugin\Controller\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\BitBag\SyliusVueStorefrontPlugin\Controller\JsonApiTestCase;
use Tests\BitBag\SyliusVueStorefrontPlugin\Controller\Utils\UserLoginTrait;

final class GetOrderHistoryActionTest extends JsonApiTestCase
{
    use UserLoginTrait;

    public function test_getting_order_history(): void
    {
        $this->loadFixturesFromFiles([
            'channel.yaml',
            'customer.yaml',
            'order_completed.yaml',
            'order_item.yaml',
            'coupon_based_promotion.yaml',
            'product_with_attributes.yaml',
        ]);

        $this->authenticateUser('test@example.com', 'MegaSafePassword');

        $uri = sprintf(
            '/vsbridge/user/order-history?token=%s&pageSize=%d&currentPage=%d',
            $this->token,
            21,
            1
        );

        $this->request(Request::METHOD_GET, $uri, self::JSON_REQUEST_HEADERS);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'Controller/User/get_order_history_successful');
    }

    public function test_getting_order_history_for_invalid_token(): void
    {
        $this->loadFixturesFromFiles(['channel.yaml', 'customer.yaml', 'order_completed.yaml', 'coupon_based_promotion.yaml']);

        $this->authenticateUser('test@example.com', 'MegaSafePassword');

        $uri = sprintf(
            '/vsbridge/user/order-history?token=%s&pageSize=%d&currentPage=%d',
            12345,
            21,
            1
        );

        $this->request('GET', $uri, self::JSON_REQUEST_HEADERS);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'Controller/User/Common/invalid_token', Response::HTTP_UNAUTHORIZED);
    }
}
