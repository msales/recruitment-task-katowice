<?php

namespace Recruitment\AdvTestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adv
 *
 * @ORM\Table(name="adv")
 * @ORM\Entity(repositoryClass="Recruitment\AdvTestBundle\Repository\AdvRepository")
 */
class Adv
{

    /**
     * @var int
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="application_id", type="integer", unique=true)
     */
    private $applicationId;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=2)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="payout", type="float", precision=4)
     */
    private $payout;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=500)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="platform", type="string", length=10, columnDefinition="ENUM('Android', 'iOS')")
     */
    private $platform;
    
    /**
     * @return int
     */
    public function getApplicationId(): int {
        return $this->applicationId;
    }
    
    /**
     * @param int $applicationId
     */
    public function setApplicationId(int $applicationId) {
        $this->applicationId = $applicationId;
    }
    
    /**
     * @return string
     */
    public function getCountry(): string {
        return $this->country;
    }
    
    /**
     * @param string $country
     */
    public function setCountry(string $country) {
        $this->country = $country;
    }
    
    /**
     * @return string
     */
    public function getPayout(): string {
        return $this->payout;
    }
    
    /**
     * @param string $payout
     */
    public function setPayout(string $payout) {
        $this->payout = $payout;
    }
    
    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
    
    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->name = $name;
    }
    
    /**
     * @return string
     */
    public function getPlatform(): string {
        return $this->platform;
    }
    
    /**
     * @param string $platform
     */
    public function setPlatform(string $platform) {
        $this->platform = $platform;
    }
    
    public function __construct() {
        
    }

    
}

