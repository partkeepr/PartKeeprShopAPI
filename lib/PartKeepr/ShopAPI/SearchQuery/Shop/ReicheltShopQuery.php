<?php
namespace PartKeepr\ShopAPI\SearchQuery\Shop;

use Buzz\Client\Curl;

use PartKeepr\ShopAPI\SearchQuery\ShopSearch,
	PartKeepr\ShopAPI\SearchQuery\AbstractSearchQuery,
	Buzz\Browser;

class ReicheltShopQuery extends AbstractSearchQuery {
	const SHOP_SERVER = "http://such001.reichelt.de";
	
	public function doQuery (ShopSearch $search) {
		$this->sendRequest($search);
	}
	
	private function sendRequest (ShopSearch $search, $page = 1) {
		$client = new Curl();
		$client->setTimeout(40);
		
		$browser = new Browser($client);

		$response = $browser->submit(
						self::SHOP_SERVER."/?ACTION=444",
						$this->getSubmitFields($search, $page)
					);
		
		$reicheltResponse = new ReicheltResponse($response);
	}
	
	
	private function getSubmitFields (ShopSearch $search, $page) {
		$pageSize = 100;
		
		return array(
				"SEARCH" => $search->getSearchTerm(),		// The search term
				"START" => ($page * $pageSize) - $pageSize,	// The start record, NOT the page number!
				"SHOW" => 0,								// Unknown
				"SSORT" => "",								// Unknown
				"SEARCH_input_hidden" => "",				// Unknown
				"OFFSET" => $pageSize						// The page size
				);
	}
	 
}