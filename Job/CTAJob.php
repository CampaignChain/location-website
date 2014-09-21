<?php
/*
 * This file is part of the CampaignChain package.
 *
 * (c) Sandro Groganz <sandro@campaignchain.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CampaignChain\Location\WebsiteBundle\Job;

use Doctrine\ORM\EntityManager;
use CampaignChain\CoreBundle\Entity\Location;
use CampaignChain\CoreBundle\Job\CTAJobInterface;
use CampaignChain\CoreBundle\Util\ParserUtil;

class CTAJob implements CTAJobInterface
{
    protected $em;
    protected $container;

    public function __construct(EntityManager $em, $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function execute(Location $location)
    {
        // Set HTML title as Location name.
        $location->setName(ParserUtil::getHTMLTitle($location->getUrl()));

        // Set the Website page module as the Location module.
        $locationService = $this->container->get('campaignchain.core.location');
        $locationModule = $locationService->getLocationModule('campaignchain/location-website', 'campaignchain-website-page');
        $location->setLocationModule($locationModule);

        // Set the image.
        $location->setImage(
            $this->container->get('templating.helper.assets')
                ->getUrl(
                    'bundles/campaignchainlocationwebsite/images/icons/256x256/page.png',
                    null
                )
        );

        return $location;
    }
}