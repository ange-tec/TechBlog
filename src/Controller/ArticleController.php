<?php

namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function fetchAllArticles(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll()
        ]);
    }

    #[Route('/articlesForm', name: 'app_form_articles')]
    public function createArticlesForm(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $article = new Article();
        $article->setDate(new \DateTime());
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $article->setUser($this->getUser());
            $entityManager->flush();
            return $this->redirectToRoute('app_articles');
        }
        return $this->render('article/article.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

    #[Route('/articles/{id}', name: 'app_article')]
    public function fetchArticleById(EntityManagerInterface $entityManager, int $id): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($id);
        if(!$article) {
            throw $this->createNotFoundException(
                'No article found for id'. $id
            );
        }
        $article->incrementViews();
        $entityManager->flush();

        return $this->render('article/article.html.twig', [
            'article' => $article
        ]);
    }


}
