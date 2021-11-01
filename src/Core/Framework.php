<?php

namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\HttpKernel;

class Framework extends HttpKernel implements HttpKernelInterface
{
    private $matcher;
    private $controllerResolver;
    private $argumentResolver;

    public function __construct(UrlMatcher $matcher, ControllerResolver $controllerResolver, ArgumentResolver $argumentResolver)
    {
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function handle(
        Request $request,
        $type = HttpKernelInterface::MASTER_REQUEST,
        $catch = true
    ) {
        $this->matcher->getContext()->fromRequest($request);

        $globalFunc = new GlobalFunc();
        // if (!$request->hasSession()) {
        //     $session = $globalFunc->beginSession();
        //     $request->setSession($session);
        // }

        // $idUser = $request->getSession()->get('idUser');
        // $urlTujuan = $request->getPathInfo();
        

        $selectPermissions = [];
        // foreach ($permissions as $key => $value) {
        //     if ($value['url'] == $urlTujuan) {
        //         $selectPermissions = $value;
        //     }
        // }

        // if ($idUser != null) {
        //     $rolePermissions = new RolePermissions();
        //     $userPermissions = $rolePermissions->selectAll("WHERE idRole = '$idRole'");
        //     $GLOBALS['userPermissions'] = $userPermissions;

        //     $hasPermissions = false;
        //     if (count($selectPermissions) > 0) {
        //         foreach ($userPermissions as $key1 => $value1) {
        //             if ($selectPermissions['aliasPermission'] == $value1['aliasPermission']) {
        //                 $hasPermissions = true;
        //                 break;
        //             }
        //         }
        //     }
        //     if (count($selectPermissions) == 0) {
        //         $selectedUrl = $urlTujuan;
        //     } else {
        //         if ($hasPermissions) {
        //             $selectedUrl = $urlTujuan;
        //         } else {
        //             $selectedUrl = '/login';
        //         }
        //     }
        // } else {
        //     if (count($selectPermissions) == 0) {
        //         $selectedUrl = $urlTujuan;
        //     } else {
        //         $selectedUrl = '/login';
        //     }
        // }

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            return new Response('Not Found', 404);
        } catch (\Exception $exception) {
            return new Response('' . $exception, 500);
        }
    }
}
