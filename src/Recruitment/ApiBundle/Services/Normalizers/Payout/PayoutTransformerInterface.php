<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 5/10/17
 * Time: 21:31
 */

namespace Recruitment\ApiBundle\Services\Normalizers\Payout;

interface PayoutTransformerInterface
{
    /**
     * @param double $data
     * @return double
     */
    public function getTransformerValue($data);
}