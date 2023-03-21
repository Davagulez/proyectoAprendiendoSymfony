<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Animal;
use Doctrine\ORM\EntityManager;
use Symfony\Component\VarDumper\VarDumper;


class AnimalController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(): Response
    {
        $animal_repo = $this->entityManager->getRepository(Animal::class);
        $animales = $animal_repo->findAll();

        //Buscar todos los animales según condiciones con findBy
        $animalesBy = $animal_repo->findBy([
            'tipo' => 'Perro - 1'
        ],[
            'id' => 'DESC'
        ]);

        //Buscar un animal dependiendo de condiciones con findOneBy
        $animal = $animal_repo->findOneBy([
            'color' => 'Negro' 
        ]);

        //Query Builder
        // $qb = $animal_repo->createQueryBuilder('a')
        //                   /* ->andWhere("a.raza = :raza")
        //                   ->setParameter('raza', 'americano') */
        //                   ->orderBy('a.id','DESC')
        //                   ->getQuery();
        // $resultset = $qb->execute();
        // var_dump($resultset);

        //DQL
        // $dql = "SELECT a FROM App\Entity\Animal a ORDER BY a.id DESC ";
        // $query = $this->entityManager->createQuery($dql);
        // $resultset = $query->execute();
        // var_dump($resultset);

        //SQL //no funciona esté código para esta version.
        // $conection = $this->entityManager->getConnection();
        // $sql = 'SELECT * FROM animales ORDER BY id DESC';
        // $stmt = $conection->prepare($sql);
        // $stmt->execute();
        // $resultset = $stmt->fetchAllAssociative();
        // var_dump($resultset);

        //Repositorio
        $animals = $animal_repo->findByRaza('DESC');
        var_dump($animals);


        return $this->render('animal/index.html.twig', [
            'controller_name' => 'AnimalController',
            'animales' => $animales,
            'animalesBy' => $animalesBy,
            'animal' => $animal
        ]);
    }

    public function save()
    {
        //guardar en una tabla de la base de datos
        //cargo el Entity Manager (Update: el entityManager siempre esta cargado)

        //Creo el objeto y le doy valores
        $animal = new Animal();
        $animal->setTipo('Avestruz');
        $animal->setColor('Verde');
        $animal->setRaza('Africana');

        // guardar objeto en doctrine
        $this->entityManager->persist($animal);

        //guardar en la base de datos
        $this->entityManager->flush();
        return new Response('El animal que tiene guardado en la base de datos tiene un id: '.$animal->getId());
    }

    public function oneAnimal(Animal $animal)
            //se reemplazo el $id, por declarar el tipo de dato y de donde pertenece. Es decir, Animal $animal. Lo que generá es que se pueda hacer la petición directamente sin hacer las peticiones comentadas.
    {
        /* //Cargar repositorio
        $animal_repo = $this->entityManager->getRepository(Animal::class);
        //Consultar
        $animal = $animal_repo->find($id); */

        //Comprobar si el resultado es correcto
        if (!$animal) {
            $message = 'El animal no existe';
        } else {
            $message = 'Tu animal elegido es: '.$animal->getTipo().' - '.$animal->getRaza();
        }
        return new Response($message);
    }

    public function updateAnimal(Animal $animal)   
    {
        //doctrine y entity manager (En este momento estas dos opciones están obsoletas. Ya estoy llamando directamente a Entity Manager)
        
        // Cargar repo Animal
        //$animal_repo = $this->entityManager->getRepository(Animal::class); // reemplaze la variable de la función para que me busque directamente
        
        //find para conseguir objeto
        //$animal = $animal_repo->find($id); // reemplaze la variable de la función para que me busque directamente
        
        //verificar si llega el objeto
        if (!$animal){
            $message = 'El animal no existe maestro';
        } else {
            
            // Asignarle nuevos valores al objeto
            $animal->setTipo('Perro'.' - '.$animal->getId());
            $animal->setColor('rojo');

            //persistir en doctrine
            $this->entityManager->persist($animal);

            //guardar en la base de datos
            $this->entityManager->flush();

            $message = 'Has actualizado el Animal '.$animal->getId();
        }
        
        //respuesta
        return new Response($message);
    }

    public function deleteAnimal(Animal $animal)
    {
        if ($animal && is_object($animal)) {
            $this->entityManager->remove($animal);
            $this->entityManager->flush();    
            $message="Animal borrado Correctamente";
        } else {
            $message="Animal no encontrado";
        }
        
        
        return new Response($message);
    }
}
