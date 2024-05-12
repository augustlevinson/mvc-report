<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/library', name: 'book')]
    public function viewAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository->findAll();

        $data = [
            'books' => $books
        ];

        return $this->render('book/home.html.twig', $data);
    }

    #[Route('/library/create', name: 'book_create', methods: ['GET', 'POST'])]
    public function createBook(
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        $title = (string) $request->request->get('title');
        $isbn = (string) $request->request->get('isbn');
        $author = (string) $request->request->get('author');
        $image = (string) $request->request->get('image');

        $book = new Book();
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('book');
    }

    #[Route('/library/update/{id}', name: 'book_update', methods: ['GET', 'POST'])]
    public function updateBook(
        Request $request,
        ManagerRegistry $doctrine,
        BookRepository $bookRepository,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();

        $title = (string) $request->request->get('title');
        $isbn = (string) $request->request->get('isbn');
        $author = (string) $request->request->get('author');
        $image = (string) $request->request->get('image');

        $book = $bookRepository->findBookById($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('single_book', ['id' => $id]);
    }

    #[Route('/library/view/{id}', name: 'single_book', methods: ['GET'])]
    public function viewBook(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository->findBookById($id);

        $data = [
            'book' => $book
        ];

        return $this->render('book/view.html.twig', $data);
    }

    #[Route('/library/delete/{id}', name: 'book_delete', methods: ['GET', 'POST'])]
    public function deleteBook(
        Request $request,
        ManagerRegistry $doctrine,
        BookRepository $bookRepository,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('book');
    }

    #[Route('/api/library/books', name: 'library_all_json')]
    public function showAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/library/book/{isbn}', name: 'library_single_json')]
    public function getBookByIsbn(
        BookRepository $bookRepository,
        string $isbn
    ): Response {
        $book = $bookRepository
            ->findBookByIsbn($isbn);

        return $this->json($book);
    }
}
