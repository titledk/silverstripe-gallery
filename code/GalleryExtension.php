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
    /**
     * The base gallery folder
     * NOTE that this is just the configuration, and will have to be actively set by the object
     * using it, as an example {@see GalleryPage} in https://github.com/titledk/silverstripe-gallery-pagetypes
     * @config
     */
    private static $gallery_folder = 'galleries';

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
        $obj = $this->owner;
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
        return $this->owner->SortedImages()->First();
    }

    /**
     * @return string|Image
     */
    public function getCalcThumbnail()
    {
        $img = $this->owner->getFirstImage();
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
        //AssetsFolderID is set by the uploaddirrules module
        if ($this->owner->ID && $this->owner->AssetsFolderID != 0) {

            //this is the default, for non multi-language sites
            if ((!class_exists('Translatable') || ($this->owner->Locale == Translatable::default_locale()))) {
                //The upload directory is expected to have been set in {@see UploadDirRules},
                //This should be handled on the object that uses this extension!
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
