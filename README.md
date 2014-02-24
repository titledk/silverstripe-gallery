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

	SiteTree:
	  extensions:
	    - AssetsFolderExtension
	    - UploadDirRules_SiteTreeExtension
	LeftAndMain:
	  extensions:
	    - UploadDirRules_LeftAndMainExtension



