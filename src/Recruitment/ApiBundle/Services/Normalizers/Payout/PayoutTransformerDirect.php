<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 21:28
 */

namespace Recruitment\ApiBundle\Services\Normalizers\Payout;


class PayoutTransformerDirect implements PayoutTransformerInterface
{
    public function getTransformerValue($data)
    {
        return $data;
    }
}