<?php

namespace App\Controller;

use App\Dto\ProductoServicioDto;
use App\Form\Type\ProductoServicioType;
use App\Services\ProductoServicioService;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/producto-servicio')]
final class ProductoServicioController extends AbstractController
{

    private readonly ProductoServicioService $psService;
    public function __construct(ProductoServicioService $psService)
    {
        $this->psService = $psService;
    }

    #[Route('/nuevo', name: 'producto_servicio_create', methods:['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $productoServicioDto = new ProductoServicioDto();
        $form = $this->createForm(ProductoServicioType::class, $productoServicioDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                
                $this->psService->createFromDto($productoServicioDto);
                $this->addFlash('success', 'Producto / Servicio creado exitosamente.');
                return $this->redirectToRoute('producto_servicio_table');
            } catch (InvalidArgumentException $e) {
                $this->addFlash('error', $e->getMessage());
            } catch (\Throwable $th) {
                $this->addFlash('error', 'Ocurrió un error inesperado.');
            }
            return $this->redirectToRoute('producto_servicio_create');
        }
        return $this->render('producto_servicio/create-view.html.twig', [
            'movimiento' => 'Alta',
            'form' => $form,
        ]);
    }

    #[Route('/modificar/{codigo}', name: 'producto_servicio_update', methods:['GET', 'POST'])]
    public function update(Request $request, string $codigo): Response
    {
        $productoServicio = $this->psService->findOneByCodigo($codigo);
        if (!$productoServicio) {
            throw $this->createNotFoundException('No se encontró el producto o servicio.');
        }
        $productoServicioDto = $this->psService->entityToDto($productoServicio);
        $form = $this->createForm(ProductoServicioType::class, $productoServicioDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try { 
                $this->psService->updateFromDto($productoServicio, $productoServicioDto); 
                $this->addFlash('success', 'Producto / Servicio actualizado exitosamente.');
                return $this->redirectToRoute('producto_servicio_table');
            } catch (InvalidArgumentException $e) {
                $this->addFlash('error', $e->getMessage());
            } catch (\Throwable $th) {
                $this->addFlash('error', 'Ocurrió un error inesperado.'.$th->getMessage());
            }
            return $this->redirectToRoute('producto_servicio_update',['codigo' => $codigo]);
        }
        return $this->render('producto_servicio/create-view.html.twig', [
            'form' => $form,
            'movimiento' => 'Modificación',
            'productoServicio' => $productoServicio
        ]);
    }

    #[Route('/listado', name: 'producto_servicio_table')]
    public function list(Request $request): Response
    {
        try {
            $productoServicios = $this->psService->findAll();    
            $contadores = $this->psService->getCantRegistros();
        } catch (\Throwable $th) {
            $this->addFlash('error', 'Ocurrió un error inesperado.');
            $productoServicios = [];
        }
        
        return $this->render('producto_servicio/table-view.html.twig', [
            'productoServicios' => $productoServicios,
            'contadores' => $contadores
        ]);
    }


}
