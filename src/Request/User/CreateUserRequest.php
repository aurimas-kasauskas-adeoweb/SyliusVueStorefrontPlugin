<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusVueStorefrontPlugin\Request\User;

use BitBag\SyliusVueStorefrontPlugin\Command\CommandInterface;
use BitBag\SyliusVueStorefrontPlugin\Command\User\CreateUser;
use BitBag\SyliusVueStorefrontPlugin\Model\Request\User\NewCustomer;
use BitBag\SyliusVueStorefrontPlugin\Request\RequestCommandInterface;

class CreateUserRequest implements RequestCommandInterface
{
    /** @var NewCustomer */
    public $customer;

    /** @var string|null */
    public $password;

    public function getCommand(): CommandInterface
    {
        return new CreateUser($this->customer, $this->password);
    }
}
