<?php

/**
 * @copyright  Copyright (C) 2012 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Forum\Category\Ajax;

defined('KAZIST') or exit('Not Kazist Framework');

use Forum\Category\Models\CategoryModel;
use Kazist\KazistFactory;

/**
 * Dashboard Controller class for the Application
 *
 * @since  1.0
 */
class CategoryAjax {

    /**
     * Save functions
     *
     * @return  void
     *
     * @since   1.0
     * @throws  \RuntimeException
     */
    public function ajaxloadtestimonials() {

        $testimonialModel = new TestimonialModel();
        echo $testimonialModel->loadTestimonials();
        exit;
    }

}
