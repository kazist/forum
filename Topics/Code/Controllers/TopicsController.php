<?php

/*
 * This file is part of Kazist Framework.
 * (c) Dedan Irungu <irungudedan@gmail.com>
 *  For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 * 
 */

/**
 * Description of TopicsController
 *
 * @author sbc
 */

namespace Forum\Topics\Code\Controllers;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\BaseController;
use Forum\Topics\Code\Models\TopicsModel;

class TopicsController extends BaseController {

    public function detailAction() {

        $this->twig_paths[] = JPATH_ROOT . '/applications/Forum/generalviews/';

        $this->model = new TopicsModel();

        $item = $this->model->getRecord();

        $data_arr['item'] = $item;

        $this->html = $this->render('Forum:Topics:Code:views:detail.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

    public function editAction() {

        $factory = new KazistFactory;

        $this->model = new TopicsModel();

        $user = $factory->getUser();
        $item = $this->model->getRecord();

        $data_arr['item'] = $item;
        $data_arr['user'] = $user;

        $this->html = $this->render('Forum:Topics:Code:views:edit.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}
