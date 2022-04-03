<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name:'app_product', methods:'GET')]
function show(ManagerRegistry $doctrine, int $id): Response
    {
    $product = $doctrine->getRepository(Product::class)->find($id);

    if (!$product) {
        throw $this->createNotFoundException(
            'No product found for id ' . $id
        );
    }

    return $this->json([
        'data' => [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'brand' => $product->getbrand(),
            'image_src' => $product->getImageSrc(),

        ],
        'message' => 'Producto obtenido correctamente',
    ]);
    // or render a template
    // in the template, print things with {{ product.name }}
    // return $this->render('product/show.html.twig', ['product' => $product]);
}

#[Route('/product', name:'create_product', methods:'POST')]
function createProduct(ManagerRegistry $doctrine): Response
    {
    $entityManager = $doctrine->getManager();

    $product = new Product();
    $product->setName('Keyboard');
    $product->setPrice(1999);
    $product->setBrand('Genius');

    // tell Doctrine you want to (eventually) save the Product (no queries yet)
    $entityManager->persist($product);

    // actually executes the queries (i.e. the INSERT query)
    $entityManager->flush();

    return $this->json([
        'data' => [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'brand' => $product->getbrand(),
            'image_src' => $product->getImageSrc(),

        ],
        'message' => 'Producto creado correctamente',
    ]);
}
}
