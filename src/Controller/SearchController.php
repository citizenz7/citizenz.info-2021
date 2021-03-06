<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

 
class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index()
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController'
        ]);
    }

    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('query', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez un mot-clé'
                ]
            ])
            ->getForm();

        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    
    /**
     * @Route("/handleSearch", name="handleSearch")
     * @param Request $request
     */
    public function handleSearch(Request $request, ArticleRepository $repo)
    {
        $query = $request->request->get('form')['query'];

        if($query) {
            $articles = $repo->findArticlesByName($query);
        }

        return $this->render('search/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
