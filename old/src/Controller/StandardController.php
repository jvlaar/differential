<?php
	namespace App\Controller;

	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;


	class StandardController extends Controller {
		/**
		* @Route("/", name="index")
		*/
		public function index() {
			return $this->render('index.html.twig');
		}

		/**
		* @Route("/contact", name="contact")
		*/
		public function contact() {
			return $this->render('contact.html.twig');
		}

	}
?>