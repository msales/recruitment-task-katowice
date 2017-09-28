<?php
/**
 * Created by PhpStorm.
 * User: joseluislaso
 * Date: 28/9/17
 * Time: 18:43
 */
declare(strict_types=1);
namespace Recruitment\ApiBundle\Entity;

interface OfferInterface
{
    public function getName();
    public function getPayout();
    public function getApplicationId();
    public function getCountry();
    public function getPlatform();
}