<?php
namespace RaumZeitLabor\PartKeepr;

use PartKeepr\ShopAPI\SearchQuery\Shop\ReicheltShopQuery;

use PartKeepr\ShopAPI\SearchQuery\ShopSearch;

require_once 'Doctrine/Common/ClassLoader.php';
use Doctrine\Common\ClassLoader;

$classLoader = new ClassLoader('PartKeepr', dirname(__DIR__)."/lib");
$classLoader->register();

$classLoader = new ClassLoader('Buzz', dirname(__DIR__)."/vendor/Buzz/lib");
$classLoader->register();


$search = new ShopSearch();
$search->setSearchTerm("a");

$query= new ReicheltShopQuery();
$query->doQuery($search);
