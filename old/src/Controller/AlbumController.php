<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends Controller
{
    /**
     * @Route("/release", name="releases")
     */
    public function release()
    {
        return $this->render('release.html.twig');
    }

    /**
     * @Route("/releases", name="releases")
     */
    public function releases()
    {
        $albumRepository = $this->getDoctrine()->getRepository(Album::class);
        return $this->render('releases.html.twig', ['albums' => $albumRepository->findAll()]);
    }

    /**
     * @Route("admin/album", name="admin_album_index", methods="GET")
     */
    public function index(AlbumRepository $albumRepository): Response
    {
        return $this->render('album/index.html.twig', ['albums' => $albumRepository->findAll()]);
    }

    /**
     * @Route("admin/album/new", name="admin_album_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($album);
            $em->flush();

            return $this->redirectToRoute('admin_album_index');
        }

        return $this->render('album/new.html.twig', [
            'album' => $album,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/Album/{id}", name="admin_album_show", methods="GET")
     */
    public function show(int $id): Response
    {
        $albumRepository = $this->getDoctrine()->getRepository(Album::class);
        return $this->render('album/show.html.twig', ['album' => $albumRepository->find($id)]);
    }

    /**
     * @Route("admin/Album/{id}/edit", name="admin_album_edit", methods="GET|POST")
     */
    public function edit(Request $request, Album $album): Response
    {
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_album_edit', ['id' => $album->getId()]);
        }

        return $this->render('album/edit.html.twig', [
            'Album' => $album,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/Album/{id}", name="admin_album_delete", methods="DELETE")
     */
    public function delete(Request $request, Album $album): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$album->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('admin_album_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($album);
        $em->flush();

        return $this->redirectToRoute('admin_album_index');
    }
}
