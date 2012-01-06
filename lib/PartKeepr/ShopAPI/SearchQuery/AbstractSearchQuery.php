<?php
namespace PartKeepr\ShopAPI\SearchQuery;

abstract class AbstractSearchQuery {
	abstract public function doQuery (ShopSearch $search);
}