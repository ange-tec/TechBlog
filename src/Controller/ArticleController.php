<?php

namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function fetchAllArticles(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll() ;
        return $this->render('article/index.html.twig', [
            'articles' => $articles
        ]);
    }

    #[Route('/article/{id}', name: 'app_article')]
    public function fetchArticleById(EntityManagerInterface $entityManager, int $id): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($id);

        if(!$article) {
            throw $this->createNotFoundException(
                'No article found for id'. $id
            );
        }

        return
            new Response(
                $article->getTitle()
                .$article->getUser() .$article->getDate()
                .$article->getImage() .$article->getContent()
                .$article->getCategory() .$article->getView()
            );
    }


}
