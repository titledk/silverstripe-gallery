# SilverStripe Gallery

A simple gallery backend for SilverStripe 3 with advanced directory saving rules.

For a ready-to-use gallery also install the [Gallery Pagetypes module](https://github.com/titledk/silverstripe-gallery-pagetypes).

Requires:

* Upload Dir Rules
* Sortable File


## Installation

The `GalleryExtension` can be added to _any_ `DataObject`.  
Add the following to your `config.yml`:

Basics:

```yml
MyDataObject:
  extensions:
    - GalleryExtension
    #this is for the upload dir rules dependency, which takes care of
    #the relation between the gallery and it's folder
    - AssetsFolderExtension
    #TODO this can go once this module is using the latest upload dir rules dependency
    - UploadDirRules_SiteTreeExtension
LeftAndMain:
  extensions:
    - UploadDirRules_LeftAndMainExtension
```

NOTE: The `UploadDirRules_LeftAndMainExtension` is needed for using
the upload dir rules in the content area as well.

