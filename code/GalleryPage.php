<?php
/**
 * Gallery Page
 * 
 * @package gallery
 * @author Anselm Christophersen <ac@title.dk>
 * @copyright Copyright (c) 2014, Title Web Solutions
 */


class GalleryPage extends Page {

	static $singular_name = 'Gallery';
	static $plural_name = 'Galleries';
	static $description = 'A page type for listing images';

	private static $many_many = array(
		'Images' => 'Image'
	);

	// this adds the SortOrder field to the relation table. Please note that the key (in this case 'Images') 
	// has to be the same key as in the $many_many definition!
	private static $many_many_extraFields = array(
		'Images' => array('SortOrder' => 'Int')
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		
		//adding upload field - if item has already been saved
		if ($this->ID && $this->AssetsFolderID != 0) {

			//Use SortableUploadField instead of UploadField!
			//The upload directory is expected to have been set in {@see UploadDirRules},
			//and should be something like: "assets/ID-Pagename"
			//TODO: This could easily be configurable through yml files (to e.g. "assets/galleries/ID"),
			//so this module could do without the upload dir rules
			//
			//read more about adding additinoal metadata to images here:
			//http://doc.silverstripe.org/framework/en/reference/uploadfield
			$imageField = new SortableUploadField('Images', '');

			$fields->addFieldToTab('Root.Images', $imageField);

		}		
		
		return $fields;
	}


	// Use this in your templates to get the correctly sorted images
	// OR use $Images.Sort('SortOrder') in your templates which will unclutter your PHP classes
	public function SortedImages(){
		return $this->Images()->Sort('SortOrder');
	}

	public function getFirstImage(){
		return $this->SortedImages()->First();
	}
	
	public function getCalcThumbnail(){
		$img = $this->getFirstImage();
		if ($img && $img->exists())  {
			return $img->CMSThumbnail();
		} else {
			return "No thumbnail available";
		}		
	}	



}

class GalleryPage_Controller extends Page_Controller {

}