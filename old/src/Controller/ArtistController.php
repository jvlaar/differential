<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends Controller
{
    /**
     * @Route("admin/artist", name="admin_artist_index", methods="GET")
     */
    public function index(ArtistRepository $artistRepository): Response
    {
        return $this->render('artist/index.html.twig', ['artists' => $artistRepository->findAll()]);
    }

    /**
     * @Route("admin/artist/new", name="admin_artist_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($artist);
            $em->flush();

            return $this->redirectToRoute('artist_index');
        }

        return $this->render('artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/artist/{id}", name="admin_artist_show", methods="GET")
     */
    public function show(int $id): Response
    {
        return $this->render('artist/show.html.twig', ['artist' => $artistRepository->findById($id)]);
    }

    /**
     * @Route("admin/{id}/edit", name="admin_artist_edit", methods="GET|POST")
     */
    public function edit(Request $request, Artist $artist): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('artist_edit', ['id' => $artist->getId()]);
        }

        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/artist/{id}", name="admin_artist_delete", methods="DELETE")
     */
    public function delete(Request $request, Artist $artist): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$artist->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('artist_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($artist);
        $em->flush();

        return $this->redirectToRoute('artist_index');
    }
}
