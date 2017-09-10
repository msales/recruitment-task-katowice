<?php
namespace Recruitment\AdvTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiCallController extends Controller
{
    
    private $base_url;
    
    public function __construct(string $base_url)
    {
        $this->base_url = $base_url;
    }
    
    /**
     * @param string $url_to_call
     *
     * @return array
     */
    public function curlAction(string $url_to_call) : array
    {
        $curl = curl_init();
        
        $url = $this->base_url . $url_to_call;
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        
        $result = curl_exec($curl);
        
        curl_close($curl);
        
        return json_encode($result, true);
    }
    
}