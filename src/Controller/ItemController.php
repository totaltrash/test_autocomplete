<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Item;
use App\Form\ItemType;

/**
 * @Route("/item")
 */
class ItemController extends AbstractController
{
    /**
     * @Route("/show/{id}", name="item_show", methods={"GET"})
     * @Template
     */
    public function show(Item $item)
    {
        return [
            'item' => $item,
        ];
    }

    /**
     * @Route("/edit/{id}", name="item_edit", methods={"GET", "POST"})
     * @Template
     */
    public function edit(Request $request, Item $item, EntityManagerInterface $em)
    {
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('item_show', [
                'id' => $item->getId(),
            ]);
        }

        return [
            'item' => $item,
            'form' => $form->createView(),
            // 'parameters' => $parametersRepo->findAll(),
        ];
    }
}
