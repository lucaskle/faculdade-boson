<?php

namespace Secretaria\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Application\Entity\User;


class SecretariaController extends AbstractActionController
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        return new ViewModel(['users' => $users]);
    }

    public function addAction()
    {
       
    }

    public function editAction()
    {

      
    }

    public function deleteAction()
    {
       
    }
}
