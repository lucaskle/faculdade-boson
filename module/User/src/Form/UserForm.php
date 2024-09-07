<?php 
namespace User\Form;

use Laminas\Form\Form; // Classe base para criar formulários em Laminas.
use Laminas\Form\Element; // Usada para criar os diferentes tipos de elementos que compõem o formulário, como campos de texto, senha, email, etc.
use Laminas\Hydrator\ClassMethodsHydrator; // Responsável por preencher automaticamente os dados do formulário a partir de uma entidade e vice-versa

class UserForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user'); // Chama o construtor da classe base Form, definindo o nome do formulário como 'user'.
        $this->setHydrator(new ClassMethodsHydrator(false)); // Define um hidratador que mapeia automaticamente os dados do 
        // formulário para os métodos get e set da entidade associada. O parâmetro false indica que o hidratador é case-sensitive (diferencia maiúsculas e minúsculas).
        

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
            'class' => 'form-control',
        ]);

        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Name',
            ],
        ]);

        $this->add([
            'name' => 'email',
            'type' => 'email',
            'options' => [
                'label' => 'Email',
            ],
        ]);

        $this->add([
            'name' => 'email',
            'type' => Element\Email::class,
            'options' => [
                'label' => 'Email address',
                'label_attributes' => [
                    'class' => 'form-label',
                ],
            ],
            'attributes' => [
                'class' => 'form-control',
                'id' => 'exampleInputEmail1',
                'aria-describedby' => 'emailHelp',
            ],
        ]); 

        $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'Password',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Submit',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}
