<?php

namespace Aluno\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class AlunoController extends AbstractActionController
{   
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function indexAction()
    {
        return new ViewModel([
        ]);
    }
}
