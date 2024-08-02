<?php 
namespace User\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use User\Entity\User;
use User\Form\UserForm;

class UserController extends AbstractActionController
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
        $form = new UserForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = new User();
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $form->getData();
                $user->setName($data['name']);
                $user->setEmail($data['email']);
                $user->setPassword($data['password']);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $this->redirect()->toRoute('user');
            }
        }

        return new ViewModel(['form' => $form]);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('user', ['action' => 'add']);
        }

        $user = $this->entityManager->find(User::class, $id);
        if (!$user) {
            return $this->redirect()->toRoute('user');
        }

        $form = new UserForm();
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->entityManager->flush();

                return $this->redirect()->toRoute('user');
            }
        }

        return new ViewModel([
            'id' => $id,
            'form' => $form,
        ]);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('user');
        }

        $user = $this->entityManager->find(User::class, $id);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }

        return $this->redirect()->toRoute('user');
    }
}
