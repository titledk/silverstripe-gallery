# Gallery

_by title.dk/Anselm Christophersen - January 2014_


A simple gallery backend for SilverStripe 3 with advanced directory saving rules.


Requires:

* Upload Dir Rules
* Sortable File



## Installation


Add the following to your `config.yml`:


Basics:

```yml
GalleryPage:
  extensions:
    - AssetsFolderExtension
    - UploadDirRules_SiteTreeExtension
```

A more holistic approach (using upload dir rules on the entire site):


```yml
SiteTree:
  extensions:
    - AssetsFolderExtension
    - UploadDirRules_SiteTreeExtension
LeftAndMain:
  extensions:
    - UploadDirRules_LeftAndMainExtension
```

NOTE: The `UploadDirRules_LeftAndMainExtension` is needed for using
the upload dir rules in the content area as well.

