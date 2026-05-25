<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::firstOrCreate(['correo' => 'test@example.com'], [
            'nombre' => 'Milton Vladimir', 'apellidos' => 'Administrador',
            'clave' => Hash::make('123'), 'rol' => 'administrador',
        ]);

        Usuario::firstOrCreate(['correo' => 'gerente@example.com'], [
            'nombre' => 'Carlos', 'apellidos' => 'Gerente',
            'clave' => Hash::make('123'), 'rol' => 'gerente',
        ]);

        $usuarios = [
            ['nombre'=>'Juan','apellidos'=>'García','correo'=>'juan.garcia@example.com','rol'=>'gerente'],
            ['nombre'=>'María','apellidos'=>'López','correo'=>'maria.lopez@example.com','rol'=>'gerente'],
            ['nombre'=>'Carlos','apellidos'=>'Martínez','correo'=>'carlos.martinez@example.com','rol'=>'gerente'],
            ['nombre'=>'Ana','apellidos'=>'Rodríguez','correo'=>'ana.rodriguez@example.com','rol'=>'gerente'],
            ['nombre'=>'Luis','apellidos'=>'Hernández','correo'=>'luis.hernandez@example.com','rol'=>'gerente'],
            ['nombre'=>'Laura','apellidos'=>'González','correo'=>'laura.gonzalez@example.com','rol'=>'gerente'],
            ['nombre'=>'Pedro','apellidos'=>'Pérez','correo'=>'pedro.perez@example.com','rol'=>'gerente'],
            ['nombre'=>'Sofía','apellidos'=>'Sánchez','correo'=>'sofia.sanchez@example.com','rol'=>'gerente'],
            ['nombre'=>'Miguel','apellidos'=>'Ramírez','correo'=>'miguel.ramirez@example.com','rol'=>'gerente'],
            ['nombre'=>'Elena','apellidos'=>'Torres','correo'=>'elena.torres@example.com','rol'=>'gerente'],
            ['nombre'=>'Roberto','apellidos'=>'Flores','correo'=>'roberto.flores@example.com','rol'=>'gerente'],
            ['nombre'=>'Diana','apellidos'=>'Rivera','correo'=>'diana.rivera@example.com','rol'=>'gerente'],
            ['nombre'=>'Fernando','apellidos'=>'Morales','correo'=>'fernando.morales@example.com','rol'=>'gerente'],
            ['nombre'=>'Patricia','apellidos'=>'Jiménez','correo'=>'patricia.jimenez@example.com','rol'=>'gerente'],
            ['nombre'=>'Héctor','apellidos'=>'Vargas','correo'=>'hector.vargas@example.com','rol'=>'gerente'],
            ['nombre'=>'Mónica','apellidos'=>'Castro','correo'=>'monica.castro@example.com','rol'=>'gerente'],
            ['nombre'=>'Alejandro','apellidos'=>'Reyes','correo'=>'alejandro.reyes@example.com','rol'=>'gerente'],
            ['nombre'=>'Claudia','apellidos'=>'Ortega','correo'=>'claudia.ortega@example.com','rol'=>'gerente'],
            ['nombre'=>'Ricardo','apellidos'=>'Mendoza','correo'=>'ricardo.mendoza@example.com','rol'=>'gerente'],
            ['nombre'=>'Gabriela','apellidos'=>'Cruz','correo'=>'gabriela.cruz@example.com','rol'=>'gerente'],
            ['nombre'=>'Ernesto','apellidos'=>'Aguilar','correo'=>'ernesto.aguilar@example.com','rol'=>'gerente'],
            ['nombre'=>'Verónica','apellidos'=>'Medina','correo'=>'veronica.medina@example.com','rol'=>'gerente'],
            ['nombre'=>'Arturo','apellidos'=>'Guzmán','correo'=>'arturo.guzman@example.com','rol'=>'gerente'],
            ['nombre'=>'Natalia','apellidos'=>'Rojas','correo'=>'natalia.rojas@example.com','rol'=>'gerente'],
            ['nombre'=>'Sergio','apellidos'=>'Herrera','correo'=>'sergio.herrera@example.com','rol'=>'gerente'],
            ['nombre'=>'Adriana','apellidos'=>'Navarro','correo'=>'adriana.navarro@example.com','rol'=>'gerente'],
            ['nombre'=>'Enrique','apellidos'=>'Domínguez','correo'=>'enrique.dominguez@example.com','rol'=>'gerente'],
            ['nombre'=>'Lucía','apellidos'=>'Vega','correo'=>'lucia.vega@example.com','rol'=>'gerente'],
            ['nombre'=>'Manuel','apellidos'=>'Ruiz','correo'=>'manuel.ruiz@example.com','rol'=>'gerente'],
            ['nombre'=>'Silvia','apellidos'=>'Delgado','correo'=>'silvia.delgado@example.com','rol'=>'gerente'],
            ['nombre'=>'Andrea','apellidos'=>'Moreno','correo'=>'andrea.moreno@example.com','rol'=>'cliente'],
            ['nombre'=>'Jorge','apellidos'=>'Ibarra','correo'=>'jorge.ibarra@example.com','rol'=>'cliente'],
            ['nombre'=>'Karla','apellidos'=>'Espinoza','correo'=>'karla.espinoza@example.com','rol'=>'cliente'],
            ['nombre'=>'Oscar','apellidos'=>'Lara','correo'=>'oscar.lara@example.com','rol'=>'cliente'],
            ['nombre'=>'Beatriz','apellidos'=>'Campos','correo'=>'beatriz.campos@example.com','rol'=>'cliente'],
            ['nombre'=>'Raúl','apellidos'=>'Fuentes','correo'=>'raul.fuentes@example.com','rol'=>'cliente'],
            ['nombre'=>'Mariana','apellidos'=>'Pacheco','correo'=>'mariana.pacheco@example.com','rol'=>'cliente'],
            ['nombre'=>'Víctor','apellidos'=>'Sandoval','correo'=>'victor.sandoval@example.com','rol'=>'cliente'],
            ['nombre'=>'Estela','apellidos'=>'Contreras','correo'=>'estela.contreras@example.com','rol'=>'cliente'],
            ['nombre'=>'Pablo','apellidos'=>'Guerrero','correo'=>'pablo.guerrero@example.com','rol'=>'cliente'],
            ['nombre'=>'Rosa','apellidos'=>'Alvarado','correo'=>'rosa.alvarado@example.com','rol'=>'cliente'],
            ['nombre'=>'Hugo','apellidos'=>'Ríos','correo'=>'hugo.rios@example.com','rol'=>'cliente'],
            ['nombre'=>'Carmen','apellidos'=>'Núñez','correo'=>'carmen.nunez@example.com','rol'=>'cliente'],
            ['nombre'=>'Julio','apellidos'=>'Soto','correo'=>'julio.soto@example.com','rol'=>'cliente'],
            ['nombre'=>'Daniela','apellidos'=>'Valdez','correo'=>'daniela.valdez@example.com','rol'=>'cliente'],
            ['nombre'=>'Felipe','apellidos'=>'Cabrera','correo'=>'felipe.cabrera@example.com','rol'=>'cliente'],
            ['nombre'=>'Isabel','apellidos'=>'Ponce','correo'=>'isabel.ponce@example.com','rol'=>'cliente'],
            ['nombre'=>'Tomás','apellidos'=>'Acosta','correo'=>'tomas.acosta@example.com','rol'=>'cliente'],
            ['nombre'=>'Gloria','apellidos'=>'Montes','correo'=>'gloria.montes@example.com','rol'=>'cliente'],
            ['nombre'=>'Álvaro','apellidos'=>'Serrano','correo'=>'alvaro.serrano@example.com','rol'=>'cliente'],
            ['nombre'=>'Irene','apellidos'=>'Peña','correo'=>'irene.pena@example.com','rol'=>'cliente'],
            ['nombre'=>'Marcos','apellidos'=>'Ramos','correo'=>'marcos.ramos@example.com','rol'=>'cliente'],
            ['nombre'=>'Alicia','apellidos'=>'Figueroa','correo'=>'alicia.figueroa@example.com','rol'=>'cliente'],
            ['nombre'=>'Ignacio','apellidos'=>'Estrada','correo'=>'ignacio.estrada@example.com','rol'=>'cliente'],
            ['nombre'=>'Norma','apellidos'=>'Cortés','correo'=>'norma.cortes@example.com','rol'=>'cliente'],
            ['nombre'=>'Rodrigo','apellidos'=>'Villanueva','correo'=>'rodrigo.villanueva@example.com','rol'=>'cliente'],
            ['nombre'=>'Teresa','apellidos'=>'León','correo'=>'teresa.leon@example.com','rol'=>'cliente'],
            ['nombre'=>'Gustavo','apellidos'=>'Bravo','correo'=>'gustavo.bravo@example.com','rol'=>'cliente'],
            ['nombre'=>'Pilar','apellidos'=>'Cervantes','correo'=>'pilar.cervantes@example.com','rol'=>'cliente'],
            ['nombre'=>'Jaime','apellidos'=>'Molina','correo'=>'jaime.molina@example.com','rol'=>'cliente'],
            ['nombre'=>'Leticia','apellidos'=>'Carrillo','correo'=>'leticia.carrillo@example.com','rol'=>'cliente'],
            ['nombre'=>'Horacio','apellidos'=>'Vázquez','correo'=>'horacio.vazquez@example.com','rol'=>'cliente'],
            ['nombre'=>'Ximena','apellidos'=>'Olvera','correo'=>'ximena.olvera@example.com','rol'=>'cliente'],
            ['nombre'=>'Gerardo','apellidos'=>'Trejo','correo'=>'gerardo.trejo@example.com','rol'=>'cliente'],
            ['nombre'=>'Concepción','apellidos'=>'Salinas','correo'=>'concepcion.salinas@example.com','rol'=>'cliente'],
            ['nombre'=>'Armando','apellidos'=>'Blanco','correo'=>'armando.blanco@example.com','rol'=>'cliente'],
            ['nombre'=>'Esperanza','apellidos'=>'Cano','correo'=>'esperanza.cano@example.com','rol'=>'cliente'],
            ['nombre'=>'Rubén','apellidos'=>'Macias','correo'=>'ruben.macias@example.com','rol'=>'cliente'],
            ['nombre'=>'Yolanda','apellidos'=>'Escobedo','correo'=>'yolanda.escobedo@example.com','rol'=>'cliente'],
            ['nombre'=>'César','apellidos'=>'Palomino','correo'=>'cesar.palomino@example.com','rol'=>'cliente'],
            ['nombre'=>'Francisca','apellidos'=>'Uribe','correo'=>'francisca.uribe@example.com','rol'=>'cliente'],
        ];

        foreach ($usuarios as $u) {
            Usuario::firstOrCreate(['correo' => $u['correo']], [
                'nombre' => $u['nombre'], 'apellidos' => $u['apellidos'],
                'clave' => Hash::make('123'), 'rol' => $u['rol'],
            ]);
        }

        $cats = ['Electrónica','Ropa','Hogar','Deportes','Juguetes','Libros','Alimentos','Herramientas','Belleza','Automóviles'];
        foreach ($cats as $nombre) {
            Categoria::firstOrCreate(['nombre' => $nombre]);
        }
    }
}
