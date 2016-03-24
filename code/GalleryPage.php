<?php

/**
 * GalleryPage
 *
 * @author Anselm Christophersen <ac@anselm.dk>
 * @date   2014-2016
 *
 * StartGeneratedWithDataObjectAnnotator
 * @method ManyManyList|Image[] Images
 * EndGeneratedWithDataObjectAnnotator
 */
class GalleryPage extends Page
{
    private static $singular_name = 'Gallery';
    private static $plural_name = 'Galleries';
    private static $description = 'A page type for listing images';
    private static $allowed_children = [];
    private static $icon = 'gallery/images/pageicons/gallery.png';

    private static $many_many = [
        'Images' => 'Image',
    ];
    private static $many_many_extraFields = [
        'Images' => ['SortOrder' => 'Int'],
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        //adding upload field - if item has already been saved
        if ($this->ID && $this->AssetsFolderID != 0) {

            //this is the default, for non multi-language sites
            if ((!class_exists('Translatable') || ($this->Locale == Translatable::default_locale()))) {
                //The upload directory is expected to have been set in {@see UploadDirRules},
                //and should be something like: "assets/ID-Pagename"
                //TODO: This could easily be configurable through yml files (to e.g. "assets/galleries/ID"),
                $imageField = SortableUploadField::create('Images', '')
                    ->setAllowedFileCategories('image');
                $fields->addFieldToTab('Root.Images', $imageField);
            } else {
                //Note that images are administered in the original language
                $orig = $this->getTranslation(Translatable::default_locale());
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
        return $fields;
    }

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
}

class GalleryPage_Controller extends Page_Controller
{
}
