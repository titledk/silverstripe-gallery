<?php

/**
 * GalleryHolder
 *
 * @author Anselm Christophersen <ac@anselm.dk>
 * @date   2014-2016
 */
class GalleryHolder extends Page
{
    private static $singular_name = 'Gallery Holder';
    private static $plural_name = 'Gallery Holders';
    private static $description = 'Holder for galleries';

    private static $icon = 'gallery/images/pageicons/gallery-holder.png';

    private static $default_child = 'GalleryPage';
    private static $allowed_children = ['GalleryPage'];

    /**
     * @return Image
     */
    public function getFirstImage()
    {
        $firstChild = $this->Children()->First();
        if ($firstChild &&
            ($firstChild->ClassName == 'GalleryPage' ||
             $firstChild->ClassName == 'GalleryHolder')) {
            return $firstChild->getFirstImage();
        }
    }
}
class GalleryHolder_Controller extends Page_Controller
{
}
