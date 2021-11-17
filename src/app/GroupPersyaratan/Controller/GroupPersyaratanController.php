<?php

namespace App\GroupPersyaratan\Controller;

use App\GroupPersyaratan\Model\GroupPersyaratan;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class GroupPersyaratanController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new GroupPersyaratan();
    }
}
