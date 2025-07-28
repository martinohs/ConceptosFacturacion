<?php

namespace App\Command;

use App\Entity\CondicionIva;
use App\Entity\Rubro;
use App\Entity\UnidadMedida;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:seed-parametricas',
    description: 'Completo con valores por defecto las parametricas de : CondicionIva, Rubro y UnidadMedida.',
)]
class SeedParametricasCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $condicionIvaRepo = $this->entityManager->getRepository(CondicionIva::class);
        if ($condicionIvaRepo->count([]) > 0) {
            $io->warning('Las parametricas ya poseen información, no se realizarán nuevas.');
            return Command::SUCCESS;
        }

        $this->seedCondicionesIva($io);
        $this->seedRubros($io);
        $this->seedUnidadesMedida($io);
        $this->entityManager->flush();

        $io->success('Parametricas cargadas con exito!');

        return Command::SUCCESS;
    }

    private function seedCondicionesIva(SymfonyStyle $io): void
    {
        $io->section('Cargando en CondicionIva...');

        $data = [
            ['codigo' => 1, 'condicionIva' => 'IVA Responsable Inscripto', 'alicuota' => '21.000'],
            ['codigo' => 4, 'condicionIva' => 'IVA Sujeto Exento', 'alicuota' => '0.000'],
            ['codigo' => 5, 'condicionIva' => 'Consumidor Final', 'alicuota' => '21.000'],
            ['codigo' => 6, 'condicionIva' => 'Responsable Monotributo', 'alicuota' => '0.000'],
            ['codigo' => 7, 'condicionIva' => 'Sujeto no Categorizado', 'alicuota' => '21.000'],
            ['codigo' => 13, 'condicionIva' => 'Monotributista Social', 'alicuota' => '0.000'],
        ];

        foreach ($data as $item) {
            $entity = new CondicionIva();
            $entity->setCodigo($item['codigo']);
            $entity->setCondicionIva($item['condicionIva']);
            $entity->setAlicuota($item['alicuota']);
            $this->entityManager->persist($entity);
            $io->writeln(sprintf('  <info>✓</info> Created CondicionIva: %s', $item['condicionIva']));
        }
    }

    private function seedRubros(SymfonyStyle $io): void
    {
        $io->section('Cargando en Rubro...');

        $data = ['Almacén', 'Bebidas', 'Librería', 'Limpieza', 'Servicios Profesionales', 'Consultoría'];

        foreach ($data as $item) {
            $entity = new Rubro();
            $entity->setRubro($item);
            $this->entityManager->persist($entity);
            $io->writeln(sprintf('  <info>✓</info> Created Rubro: %s', $item));
        }
    }

    private function seedUnidadesMedida(SymfonyStyle $io): void
    {
        $io->section('Cargando en UnidadMedida...');

        $data = [
            ['codigo' => 'UN', 'unidadMedida' => 'Unidad'],
            ['codigo' => 'KG', 'unidadMedida' => 'Kilogramo'],
            ['codigo' => 'LTS', 'unidadMedida' => 'Litros'],
            ['codigo' => 'MTS', 'unidadMedida' => 'Metros'],
            ['codigo' => 'HORA', 'unidadMedida' => 'Hora'],
            ['codigo' => 'SERV', 'unidadMedida' => 'Servicio Global'],
        ];

        foreach ($data as $item) {
            $entity = new UnidadMedida();
            $entity->setCodigo($item['codigo']);
            $entity->setUnidadMedida($item['unidadMedida']);
            $this->entityManager->persist($entity);
            $io->writeln(sprintf('  <info>✓</info> Created UnidadMedida: %s', $item['unidadMedida']));
        }
    }
}