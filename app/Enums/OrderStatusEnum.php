<?php

namespace App\Enums;

use YooKassa\Common\AbstractEnum;

class OrderStatusEnum extends AbstractEnum
{
    public const CREATED = 'CREATED';
    public const RECEIVED = 'RECEIVED';
    public const DELIVERING = 'DELIVERING';
    public const DELIVERED = 'DELIVERED';
    public const DELETE = 'DELETE';
}
