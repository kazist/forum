<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Forum\Topics\Code\Models;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Model\BaseModel;
use Kazist\KazistFactory;

/**
 * Description of MarketplaceModel
 *
 * @author sbc
 */
class TopicsModel extends BaseModel {

    public function loadTopics() {
        $paths = array();

        $object_arr = new \stdClass();
        $factory = new KazistFactory();
        $input = $factory->getInput();

        $offset = $this->request->request->get('offset');
        $action = $this->request->request->get('action');

        $object_arr->offset = ($action == 'previous') ? $offset - 2 : $offset + 2;

        $template = 'testimonial.list.twig';
        $this->twig_paths[] = realpath(JPATH_ROOT . '/applications/Forum/generalviews');
        $html = $factory->renderData($object_arr, $template, $paths);


        return $html;
    }

}
