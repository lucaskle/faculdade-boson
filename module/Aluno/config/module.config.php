<?php

use Aluno\Controller\AlunoController;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'aluno' => [
                'type' => Segment::class, //Define que o tipo da rota é um segmento de URL. Isso significa que a rota pode capturar partes da URL como /user, /user/edit, ou /user/edit/123.
                'options' => [
                    'route' => '/aluno[/:action[/:id]]', //Define a estrutura da URL. [/:action[/:id]] indica que action e id são parâmetros opcionais.
                    'constraints' => [ //Define restrições para esses parâmetros. Por exemplo, action deve ser uma string alfanumérica
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [ // Define valores padrão para a rota, como o controlador e a ação.
                        'controller' => AlunoController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        // a fábrica é uma função anônima que retorna uma nova instância de UserController, injetando o gerenciador de entidades do Doctrine.
        'factories' => [
            AlunoController::class => function ($container) {
                return new AlunoController(
                    $container->get('doctrine.entitymanager.orm_default')
                );
            },
        ],

        // 'invokables' => [
        //     'Aluno\Controller\AlunoController' => AlunoController::class
        // ],
    ],
    'view_manager' => [
        'template_map' => [
            'aluno/aluno/index' => __DIR__ . '/../view/aluno/aluno/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [ // Define os drivers de mapeamento de entidades
            'Aluno_drive' => [ // Nome do driver para o módulo User.
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array', // Define o cache para as anotações
                'paths' => [__DIR__ . '/../../Application/src/Entity'], //specifica o caminho onde as entidades do módulo User estão localizadas,
            ],
            'orm_default' => [ // Esta chave é usada para configurar o driver padrão do ORM. Ela associa o namespace User\Entity ao driver Aluno_drive
                'drivers' => [
                    'Application\Entity' => 'Application_driver',
                ],
            ],
        ],
    ],
];
