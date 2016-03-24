<?php
/**
 * Gallery Holder.
 *
 * @author Anselm Christophersen <ac@title.dk>
 * @copyright Copyright (c) 2014, Title Web Solutions
 */
class GalleryHolder extends Page
{
    public static $singular_name = 'Gallery Holder';
    public static $plural_name = 'Gallery Holders';
    public static $description = 'Holder for galleries';

    private static $icon = 'gallery/images/pageicons/gallery-holder.png';

    private static $default_child = 'GalleryPage';
    private static $allowed_children = array('GalleryPage');

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
