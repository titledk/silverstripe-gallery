<?php
/**
 * Gallery image extension
 * Adds the many many relation to galleries to the {@see Image} class
 * 
 * @package portfolio
 * @author Anselm Christophersen <ac@title.dk>
 * @copyright Copyright (c) 2014, Title Web Solutions
 */

class GalleryImageExtension extends DataExtension {
	
	private static $belongs_many_many = array(
		'Galleries' => 'GalleryPage'   
	);
}