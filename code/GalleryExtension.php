<?php

/**
 * GalleryExtension
 *
 * @author Anselm Christophersen <ac@anselm.dk>
 * @date   March 2016
 */

/**
 * StartGeneratedWithDataObjectAnnotator
 * @property GalleryPage|GalleryExtension owner
 * @method ManyManyList|Image[] Images
 * EndGeneratedWithDataObjectAnnotator
 */
class GalleryExtension extends DataExtension
{
    private static $many_many = [
        'Images' => 'Image',
    ];
    private static $many_many_extraFields = [
        'Images' => ['SortOrder' => 'Int'],
    ];

    /**
     * @return DataList
     */
    public function SortedImages()
    {
        $obj = $this;
        //translatable support
        if (class_exists('Translatable') && ($this->Locale != Translatable::default_locale())) {
            $obj = $this->getTranslation(Translatable::default_locale());
        }
        return $obj->Images()->Sort('SortOrder');
    }

    /**
     * @return DataObject
     */
    public function getFirstImage()
    {
        return $this->SortedImages()->First();
    }

    /**
     * @return string|Image
     */
    public function getCalcThumbnail()
    {
        $img = $this->getFirstImage();
        if ($img && $img->exists()) {
            return $img->CMSThumbnail();
        } else {
            return 'No thumbnail available';
        }
    }

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        //adding upload field - if item has already been saved
        if ($this->owner->ID && $this->owner->AssetsFolderID != 0) {

            //this is the default, for non multi-language sites
            if ((!class_exists('Translatable') || ($this->owner->Locale == Translatable::default_locale()))) {
                //The upload directory is expected to have been set in {@see UploadDirRules},
                //and should be something like: "assets/ID-Pagename"
                //TODO: This could easily be configurable through yml files (to e.g. "assets/galleries/ID"),
                $imageField = SortableUploadField::create('Images', '')
                    ->setAllowedFileCategories('image');
                $fields->addFieldToTab('Root.Images', $imageField);
            } else {
                //Note that images are administered in the original language
                $orig = $this->owner->getTranslation(Translatable::default_locale());
                $html = sprintf(
                    '<a href="%s">%s</a>',
                    Controller::join_links(
                        $orig->CMSEditLink(),
                        '?locale='.$orig->Locale
                    ),
                    'Images are administered through '
                    .i18n::get_locale_name($orig->Locale)
                );
                $fields->addFieldToTab('Root.Images',
                    LiteralField::create('ImagesDesc', $html)
                );
            }
        }
    }

}
