<?php

namespace Recruitment\ApiBundle\Entity;


interface PayoutInterface
{
    public function setPayout($amount);
    public function setCurrency(Currency $currency);
    public function getPayout();
    public function getCurrency();
}