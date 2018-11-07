<?php

namespace Badtrends\Containers;

use Badtrends\Config\BadtrendsConfig;
use IO\Services\ItemSearch\SearchPresets\TagItems;
use IO\Services\ItemSearch\Services\ItemSearchService;
use Plenty\Plugin\Templates\Twig;

class BadtrendsItemListContainer3
{
    public function call(Twig $twig, $arg):string
    {
        $tagList = [];
        
        /** @var BadtrendsConfig $badtrendsConfig */
        $badtrendsConfig = pluginApp(BadtrendsConfig::class);
    
        $listType = $badtrendsConfig->itemLists->list3Type;
    
        if($listType == 'tag_list')
        {
            /** @var ItemSearchService $itemSearchService */
            $itemSearchService = pluginApp( ItemSearchService::class );
        
            $itemSearchOptions = [
                'tagIds' => explode(',', $badtrendsConfig->itemLists->list3TagIds),
                'sorting' => $badtrendsConfig->itemLists->tagSorting
            ];
        
            $result = $itemSearchService->getResults([
                                                         'tagItems' => TagItems::getSearchFactory( $itemSearchOptions )
                                                     ]);
        
            if(count($result['tagItems']))
            {
                $tagList = $result['tagItems']['documents'];
            }
        }
        
        return $twig->render('Badtrends::Containers.ItemLists.ItemList3', ["item" => $arg[0], "itemList" => $tagList]);
    }
}