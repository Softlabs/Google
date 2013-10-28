<?php namespace Softlabs\Google;

require_once "../vendor/softlabs/google-api-php-client/src/Google_Client.php";
require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_CalendarService.php";

// TODO: figure it out, how to require more than 1 class without redeclaring classes
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_AdExchangeSellerService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_AdSenseService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_AdexchangebuyerService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_AdsensehostService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_AnalyticsService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_AndroidpublisherService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_AppstateService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_AuditService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_BigqueryService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_BloggerService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_BooksService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_CalendarService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_CivicInfoService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_ComputeService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_CoordinateService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_CustomsearchService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_DatastoreService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_DfareportingService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_DirectoryService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_DriveService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_FreebaseService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_FusiontablesService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_GamesManagementService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_GamesService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_GanService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_GroupssettingsService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_LicensingService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_MirrorService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_ModeratorService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_Oauth2Service.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_OrkutService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_PagespeedonlineService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_PlusDomainsService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_PlusService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_PredictionService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_ReportsService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_ResellerService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_SQLAdminService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_ShoppingService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_SiteVerificationService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_StorageService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_TaskqueueService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_TasksService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_TranslateService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_UrlshortenerService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_WebfontsService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_YouTubeAnalyticsService.php";
// require_once "../vendor/softlabs/google-api-php-client/src/contrib/Google_YouTubeService.php";

use \Config as Config;

class Google
{

    public function __construct() {

        $config = array(
            'oauth2_client_id' => Config::get('google.client-id'),
            'use_objects' => true,
        );

        $this->client = new \Google_Client($config);

        $this->client->setAccessType('offline');

        $this->client->setAssertionCredentials(
            new \Google_AssertionCredentials(
                Config::get('google.service-account-name'),
                Config::get('google.scope'),
                file_get_contents(Config::get('google.key-file'))
            )
        );
    }

    /**
     * Creates a google service.
     *
     * @param $serviceName string Service name.
     */
    public function createService($serviceName)
    {
        $className = "\Google_" . $serviceName . "Service";
        $service = new $className($this->client);

        return $service;
    }

}