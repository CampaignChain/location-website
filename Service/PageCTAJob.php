<?php
/*
 * Copyright 2016 CampaignChain, Inc. <info@campaignchain.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace CampaignChain\Location\WebsiteBundle\Service;

use CampaignChain\CoreBundle\EntityService\LocationService;
use CampaignChain\CoreBundle\Entity\Location;
use CampaignChain\CoreBundle\Job\JobCTAInterface;
use CampaignChain\CoreBundle\Util\ParserUtil;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\AssetsHelper;

class PageCTAJob implements JobCTAInterface
{
    /** @var  LocationService */
    protected $locationService;

    /** @var AssetsHelper */
    protected $assetsHelper;

    public function __construct(LocationService $locationService, AssetsHelper $assetsHelper)
    {
        $this->locationService = $locationService;
        $this->assetsHelper = $assetsHelper;
    }

    public function execute(Location $location)
    {
        // Set HTML title as Location name.
        $location->setName(ParserUtil::getHTMLTitle($location->getUrl()));

        // Set the Website page module as the Location module.
        $locationModule = $this->locationService->getLocationModule('campaignchain/location-website', 'campaignchain-website-page');
        $location->setLocationModule($locationModule);

        // Set the image.
        $location->setImage(
            $this->assetsHelper
                ->getUrl(
                    'bundles/campaignchainlocationwebsite/images/icons/256x256/page.png',
                    null
                )
        );

        return $location;
    }
}