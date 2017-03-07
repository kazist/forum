<?php

/*
 * This file is part of Kazist Framework.
 * (c) Dedan Irungu <irungudedan@gmail.com>
 *  For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 * 
 */

/**
 * Description of CategoriesController
 *
 * @author sbc
 */

namespace Forum\Categories\Code\Controllers;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\BaseController;
use Forum\Categories\Code\Models\CategoriesModel;

class CategoriesController extends BaseController {

    public function indexAction() {

        $this->twig_paths[] = JPATH_ROOT . '/applications/Forum/generalviews/';

        $this->model = new CategoriesModel();

        $items = $this->model->getRecords();
        $items = $this->model->getAdditionalDetail($items);

        $data_arr['items'] = $items;

        $this->html = $this->render('Forum:Categories:Code:views:table.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

    public function detailAction() {

        $this->twig_paths[] = JPATH_ROOT . '/applications/Forum/generalviews/';

        $this->model = new CategoriesModel();

        $item = $this->model->getRecord();

        $data_arr['item'] = $item;

        $this->html = $this->render('Forum:Categories:Code:views:detail.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

    public function editAction() {

        $factory = new KazistFactory;

        $this->model = new CategoriesModel();

        $item = $this->model->getRecord();
        $user = $factory->getUser();

        $data_arr['user'] = $user;
        $data_arr['item'] = $item;

        $this->html = $this->render('Forum:Categories:Code:views:edit.index.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}
