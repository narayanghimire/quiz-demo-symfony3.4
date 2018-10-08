<?php

namespace QuizBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class userType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fname')
	            ->add('lname');
    }

    public function getParent() {
	return 'FOS\UserBundle\Form\Type\RegistrationFormType';
	}

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'quizbundle_user';
    }

	public function getName()

	{
		return $this->getBlockPrefix();
	}
}
