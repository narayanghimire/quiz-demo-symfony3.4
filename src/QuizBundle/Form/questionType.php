<?php

namespace QuizBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class questionType extends AbstractType {

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('text', TextType::class, [
			'label'    => 'Enter Question',
			'required' => true,
			'attr'     => [
				'class' => 'input100'
			]
		])
			->add('qAnswer', TextType::class, [
				'label'    => 'Enter Answer',
				'required' => true,
				'attr'     => [
					'class' => 'input100'
				]
			]);
		$builder->add('type', HiddenType::class, [
			'data' => 'question'

		]);
		$builder->add('submit', SubmitType::class, [
			'label' => 'Submit',
			'attr'  => [
				'class' => 'contact100-form-btn'
			]
		]);
	}


	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
			'data_class' => 'QuizBundle\Entity\question'
		]);
	}


	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'quizbundle_question';
	}

}
