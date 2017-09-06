# mSales test for Max Novelli

In this file, I will provide the end points creted, their usage and a brief description of all the classes that I added to the project in the effort to meet the requirements.

## end points
Here is the list of the end points that I created using FOSRestController and REST Annotation:

- /offer/process/advertiser/{advertiserId}
    Provided a valid advertiser id, this end point retrieve all the offers for the advertiser and create as many offer entities as needed.
    The procedure is not aware if it has been run before or not, so if it is called multiple time, it will create duplicates (with different application_id)
    This end points return a json object with the following fields:
    - result : success
    - offersCreated : number of offer entities created with this call
    - recordsProcessed : number of advertiser offer records processed in this call
    - recordsSkipped : number of advertiser offer records that have been skipped. The reason why that happens is not reported.

- /offer/{applicationId}
    Retrieve the offer with the specified application id in json format. If an offer does not exists, it will return blank.
  
- /offers/all
    Retrieve all the offer entities that are present in the database at the moment.

- /offers/delete/all
    Delete all the offer entries currently present in the database
    This end point will return the following json object:
    - result : success
    - offersRemoved : number of offer entities that have been removed from the database
    
    
## classes
- /Recruitment/ApiBundle/Controller/OfferController.php
    This class implements all the code handling the 4 end points listed above
    
- /Recruitment/ApiBundle/Util/ApiAdvertiserOffer/Abstraction
    This is an abstract class defining the main properties of an offer and the get method used when creating the offer entity
    
- /Recruitment/ApiBundle/Util/ApiAdvertiserOffer/AdvertiserOffer
    This is the folder containing the specific advertiser offer classes that extanded the abstract advertiser class.
    They customize the constructor to map the fields of the advertiser to the offer entity and the static method handling multiple objects due to multiple countries
    
- /Recruitment/ApiBundle/Util/ApiAdvertiserOffer/Factory
    This is the factory class that takes care of calling the right advertiser class when given an advertiser offer record.
    
-  /Recruitment/ApiBundle/Util/ApiCountries
    This class implement the conversion from ISO 3166-1 alpha-2 to ISO 3166-1 alpha-3 and viceversa.
    The iso3.json file has been downloaded from the folloing url: http://country.io/iso3.json.
    It could be implemented that the clas populates its internal structure directly from the URL, but I opted to have a local copy of the file because of performances and the need to work off line
    
- /tests/AppBundle/Controller/OfferControllerTest.php
    Functional tests on the offer controller test. Not yet fully functional because of the following error:
    > PHP Fatal error:  Class 'PHPUnit\Framework\TestCase' not found in ...vendor/symfony/symfony/src/Symfony/Bundle/FrameworkBundle/Test/KernelTestCase.php on line 24

- /tests/AppBundle/Entity/OfferEntityTest.php
    Functional tests on the offer entity. Not yet fully functional because of the same error reported above
    
- /tests/AppBundle/Util/ApiCountries.php
    Functional tests on the countries api. Functional.
    > phpunit tests/AppBundle/Util/ApiCountries/ApiContriesTest.php 
        PHPUnit 5.1.3 by Sebastian Bergmann and contributors.
        ..                                                                  2 / 2 (100%)
        Time: 23 ms, Memory: 4.00Mb
        OK (2 tests, 7 assertions)

Questions, suggestion and feedback, please email me:
Max Novelli
max@maxnovelli.info

Thank you so much
Max