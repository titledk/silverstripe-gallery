# Gallery

_by title.dk/Anselm Christophersen - January 2014_


A simple gallery backend for SilverStripe 3 with advanced directory saving rules.


Requires:

* Upload Dir Rules
* Sortable File



## Installation

### Manual

	git submodule add git@bitbucket.org:titledk/silverstripe-gallery.git public/gallery

Remember to also add upload dir rules, and sortablefile (`"bummzack/sortablefile": "*"`).

### Composer

	"repositories": [
		{
			"type": "vcs",
			"url": "git@bitbucket.org:titledk/silverstripe-gallery.git"
		},
		{
			"type": "vcs",
			"url": "git@bitbucket.org:titledk/silverstripe-uploaddirrules.git"
		}
		],
	"require" {
		"titledk/silverstripe-gallery": "*"
	}

### Instantiation

Add the following to your `config.yml`:




Basics:


	GalleryPage:
	  extensions:
	    - AssetsFolderExtension
	    - UploadDirRules_SiteTreeExtension


A more holistic approach:


	SiteTree:
	  extensions:
	    - AssetsFolderExtension
	    - UploadDirRules_SiteTreeExtension
	LeftAndMain:
	  extensions:
	    - UploadDirRules_LeftAndMainExtension

NOTE: The `UploadDirRules_LeftAndMainExtension` is needed for using
the uload dir rules in the content area as well.

