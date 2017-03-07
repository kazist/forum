<?php

/*
 * This file is part of Kazist Framework.
 * (c) Dedan Irungu <irungudedan@gmail.com>
 *  For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 * 
 */

/**
 * Description of ForumController
 *
 * @author sbc
 */

namespace Forum\Forum\Code\Controllers;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\BaseController;
use Forum\Forum\Code\Models\ForumModel;

class ForumController extends BaseController {

    public function indexAction() {

        $this->twig_paths[] = JPATH_ROOT . '/applications/Forum/generalviews/';

        $this->model = new ForumModel();

        $items = $this->model->getRecords();
        $items = $this->model->getAdditionalDetail($items);

        $data_arr['items'] = $items;

        $this->html = $this->render('Forum:Forum:Code:views:table.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

    public function detailAction() {

        $this->twig_paths[] = JPATH_ROOT . '/applications/Forum/generalviews/';

        $this->model = new ForumModel();

        $item = $this->model->getRecord();

        $data_arr['item'] = $item;

        $this->html = $this->render('Forum:Forum:Code:views:detail.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}
