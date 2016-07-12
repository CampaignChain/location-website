<?php
/*
 * This file is part of the CampaignChain package.
 *
 * (c) CampaignChain, Inc. <info@campaignchain.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CampaignChain\Location\WebsiteBundle\Service;

use CampaignChain\CoreBundle\EntityService\LocationService;
use CampaignChain\CoreBundle\Entity\Location;
use CampaignChain\CoreBundle\Job\JobCTAInterface;
use CampaignChain\CoreBundle\Util\ParserUtil;

class FormCTAJob implements JobCTAInterface
{
    /** @var  LocationService */
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function execute(Location $location)
    {
        // Set HTML title as Location name.
        $location->setName('Form on '.ParserUtil::getHTMLTitle($location->getUrl()));

        // Set the Website page module as the Location module.
        $locationModule = $this->locationService->getLocationModule('campaignchain/location-website', 'campaignchain-website-form');
        $location->setLocationModule($locationModule);

        // Set the image.
        $location->setImage(
            $this->container->get('templating.helper.assets')
                ->getUrl(
                    'bundles/campaignchainlocationwebsite/images/icons/256x256/form.png',
                    null
                )
        );

        return $location;
    }
}