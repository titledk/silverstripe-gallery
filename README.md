# Gallery

_by title.dk/Anselm Christophersen - January 2014_


A simple gallery backend for SilverStripe 3.


Requires:

* Upload Dir Rules
* Sortable File



## Installation

	git submodule add git@bitbucket.org:titledk/silverstripe-gallery.git public/gallery


Add the following to your `config.yml`:

	SiteTree:
	  extensions:
	    - AssetsFolderExtension
	    - UploadDirRules_SiteTreeExtension
	LeftAndMain:
	  extensions:
	    - UploadDirRules_LeftAndMainExtension


Add the following to your `composer.json`:

	"bummzack/sortablefile": "*"


