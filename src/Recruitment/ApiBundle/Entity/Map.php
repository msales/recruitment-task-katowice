<?php

namespace Recruitment\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="maps")
 */
class Map
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    public $advertiser_id;

    /** @ORM\Column(type="json_array") */
    public $fields;
}