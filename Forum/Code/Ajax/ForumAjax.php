<?php

/**
 * @copyright  Copyright (C) 2012 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Forum\Forum\Ajax;

defined('KAZIST') or exit('Not Kazist Framework');

use Forum\Forum\Models\ForumModel;
use Kazist\KazistFactory;

/**
 * Dashboard Controller class for the Application
 *
 * @since  1.0
 */
class ForumAjax {

    /**
     * Save functions
     *
     * @return  void
     *
     * @since   1.0
     * @throws  \RuntimeException
     */
    public function ajaxloadforums() {

        $forumModel = new ForumModel();
        echo $forumModel->loadForums();
        exit;
    }

}
