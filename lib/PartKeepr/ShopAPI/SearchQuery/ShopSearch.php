<?php
namespace PartKeepr\ShopAPI\SearchQuery;

class ShopSearch {
	private $searchTerm;
	
	public function setSearchTerm ($term) {
		$this->searchTerm = $term;
	}
	
	public function getSearchTerm () {
		return $this->searchTerm;
	}
}