<?php

namespace Goteo\Controller {

    use Goteo\Core\Error,
        Goteo\Model;

    class Image extends \Goteo\Core\Controller {

        public function index($id, $width = 200, $height = 200, $crop = false) {
            if ($image = Model\Image::get($id)) {
                $image->display($width, $height, $crop);
            } else {
                throw new Error(Error::NOT_FOUND);
            }
        }

        public function upload ($width = 200, $height = 200) {

            if (!empty($_FILES) && count($_FILES) === 1) {
                // Do upload
                $image = new Model\Image(current($_FILES));

                if ($image->save()) {
                    return $image->getLink($width, $height);
                }

            }

        }

    }

}