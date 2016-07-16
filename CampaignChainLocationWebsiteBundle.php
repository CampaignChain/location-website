<?php

namespace CampaignChain\Location\WebsiteBundle;

use CampaignChain\Location\WebsiteBundle\DependencyInjection\CampaignChainLocationWebsiteExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CampaignChainLocationWebsiteBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new CampaignChainLocationWebsiteExtension();
    }
}
