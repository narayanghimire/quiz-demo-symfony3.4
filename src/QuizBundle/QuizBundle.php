<?php

namespace QuizBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class QuizBundle extends Bundle
{

	public  function  getParent(){

		return 'FOSUserBundle';

	}
}
