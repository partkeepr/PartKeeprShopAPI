<?php
namespace PartKeepr\ShopAPI\SearchQuery\Shop;

use Buzz\Message\Response;

class ReicheltResponse {
	public function __construct (Response $response) {
		$content = $response->getContent();
		
		// Fix wrong closing tag
		$content = str_replace('</br>', '<br/>', $content);
		
		// Remove duplicate ids
		$content = str_replace('id="START"', "", $content);
		$content = str_replace('id="SSORT"', "", $content);
		$content = str_replace('id="OFFSET"', "", $content);
		$content = str_replace('id="SHOW"', "", $content);
		$content = str_replace('id="SEARCH"', "", $content);
		
		$config = array(
           'indent'         => true,
           'output-xhtml'   => true,
           'wrap'           => 200);
		
		$tidy = new \tidy;
		$tidy->parseString($content, $config, 'latin1');
		$tidy->cleanRepair();
		
		file_put_contents("out.html", tidy_get_output($tidy));
		/*return;
		$dom = $response->getContent();
		
		file_put_contents("out.html", $dom->saveXML());*/
	}
}