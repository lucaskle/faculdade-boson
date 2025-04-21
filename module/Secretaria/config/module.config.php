<?php

namespace Secretaria;

use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'secretaria' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/secretaria[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\SecretariaController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [

        'factories' => [
            Controller\SecretariaController::class => function ($container) {
                return new Controller\SecretariaController(
                    $container->get('doctrine.entitymanager.orm_default')
                );
            },
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],

        'template_map' => [
            'layout/secretaria' => __DIR__ . '/../view/layout/secretaria.phtml',
        ],


    ],
    // 'doctrine' => [
    //     'driver' => [ // Define os drivers de mapeamento de entidades
    //         'User_driver' => [ // Nome do driver para o módulo User.
    //             'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
    //             'cache' => 'array', // Define o cache para as anotações
    //             'paths' => [__DIR__ . '/../src/Entity'], //specifica o caminho onde as entidades do módulo User estão localizadas,
    //         ],
    //         'orm_default' => [ // Esta chave é usada para configurar o driver padrão do ORM. Ela associa o namespace User\Entity ao driver User_driver
    //             'drivers' => [
    //                 'User\Entity' => 'User_driver',
    //             ],
    //         ],
    //     ],
    // ],
];
