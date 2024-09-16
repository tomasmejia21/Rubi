<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //  5	Programación Web	Vamos a practicar sobre la accesibilidad en la programación web	4	202408175	2024-09-16 22:01:47	2024-09-16 22:01:47
    //  6	Accesibilidad en entornos rurales	Cómo enseñar en entornos rurales?	3	202408174	2024-09-16 22:02:29	2024-09-16 22:02:29
    //  7	Accesibilidad 1	Vamos a tratar los fundamentos de la accesibilidad	4	202408170	2024-09-16 22:03:06	2024-09-16 22:03:06
    //  8	Accesibilidad 2	Vamos a tratar con profundidad los temas de accesibilidad con respecto al código	4	202408173	2024-09-16 22:03:31	2024-09-16 22:03:31
    //  9	Enseñanza Accesible 1	¿Cómo enseñar a los alumnos de manera accesible?	3	202408174	2024-09-16 22:04:10	2024-09-16 22:04:10
    //  10	Enseñanza Accesible 2	Introducción a las formas de enseñar de forma accesible	3	202408175	2024-09-16 22:04:37	2024-09-16 22:04:37
    //  11	Presentaciones accesibles	Como crear presentaciones accesibles	3	202408172	2024-09-16 22:04:56	2024-09-16 22:04:56
    //  12	Videos accesibles	Como poder hacer videos accesibles para los alumnos	3	202408172	2024-09-16 22:05:11	2024-09-16 22:05:11
    //  13	Actividades accesibles	¿Qué actividades y cómo puedo implementarlas en mis clases?	3	202408170	2024-09-16 22:05:34	2024-09-16 22:05:34
    //  14	Programación accesible 1	Paradigmas de la programación accesible y formas de implementarlas	4	202408171	2024-09-16 22:05:56	2024-09-16 22:05:56
    //  15	Diseño web 1	Diseñar los aplicativos de manera accesible	4	202408174	2024-09-16 22:06:26	2024-09-16 22:06:26
    //  16	Accesibilidad general 1	Implementación de accesibilidad en entornos móviles	4	202408174	2024-09-16 22:07:07	2024-09-16 22:07:07
    //  17	React y accesibilidad	Cómo puedo crear una API accesible?	4	202408170	2024-09-16 22:07:28	2024-09-16 22:07:28
    //  18	Conexiones accesibles	Cómo puedo llevar mi accesibilidad a otros aplicativos?	4	202408175	2024-09-16 22:08:07	2024-09-16 22:08:07
    //  19	Inglés 1	Curso de inglés básico para programar accesible en todos los lenguajes	3	202408175	2024-09-16 22:08:35	2024-09-16 22:08:35
    //  20	Comunicación 1	¿Cómo comunicarme con los estudiantes que no me pueden entender?	3	202408172	2024-09-16 22:09:03	2024-09-16 22:09:03
    public function run(): void
    {
        DB::table('modules')->insert([
            [
                'moduleId' => 5, 
                'title' => 'Programación Web', 
                'description' => 'Vamos a practicar sobre la accesibilidad en la programación web', 
                'role_id' => 4, 
                'teacherId' => 202408175, 
                'created_at' => '2024-09-16 22:01:47', 
                'updated_at' => '2024-09-16 22:01:47'
            ],
            [
                'moduleId' => 6, 
                'title' => 'Accesibilidad en entornos rurales', 
                'description' => 'Cómo enseñar en entornos rurales?', 
                'role_id' => 3, 
                'teacherId' => 202408174, 
                'created_at' => '2024-09-16 22:02:29', 
                'updated_at' => '2024-09-16 22:02:29'
            ],
            [
                'moduleId' => 7, 
                'title' => 'Accesibilidad 1', 
                'description' => 'Vamos a tratar los fundamentos de la accesibilidad', 
                'role_id' => 4, 
                'teacherId' => 202408170, 
                'created_at' => '2024-09-16 22:03:06', 
                'updated_at' => '2024-09-16 22:03:06'
            ],
            [
                'moduleId' => 8, 
                'title' => 'Accesibilidad 2', 
                'description' => 'Vamos a tratar con profundidad los temas de accesibilidad con respecto al código', 
                'role_id' => 4, 
                'teacherId' => 202408173, 
                'created_at' => '2024-09-16 22:03:31', 
                'updated_at' => '2024-09-16 22:03:31'
            ],
            [
                'moduleId' => 9, 
                'title' => 'Enseñanza Accesible 1', 
                'description' => '¿Cómo enseñar a los alumnos de manera accesible?', 
                'role_id' => 3, 
                'teacherId' => 202408174, 
                'created_at' => '2024-09-16 22:04:10', 
                'updated_at' => '2024-09-16 22:04:10'
            ],
            [
                'moduleId' => 10, 
                'title' => 'Enseñanza Accesible 2', 
                'description' => 'Introducción a las formas de enseñar de forma accesible', 
                'role_id' => 3, 
                'teacherId' => 202408175, 
                'created_at' => '2024-09-16 22:04:37', 
                'updated_at' => '2024-09-16 22:04:37'
            ],
            [
                'moduleId' => 11, 
                'title' => 'Presentaciones accesibles', 
                'description' => 'Como crear presentaciones accesibles', 
                'role_id' => 3, 
                'teacherId' => 202408172, 
                'created_at' => '2024-09-16 22:04:56', 
                'updated_at' => '2024-09-16 22:04:56'
            ],
            [
                'moduleId' => 12, 
                'title' => 'Videos accesibles', 
                'description' => 'Como poder hacer videos accesibles para los alumnos', 
                'role_id' => 3, 
                'teacherId' => 202408172, 
                'created_at' => '2024-09-16 22:05:11', 
                'updated_at' => '2024-09-16 22:05:11'
            ],
            [
                'moduleId' => 13, 
                'title' => 'Actividades accesibles', 
                'description' => '¿Qué actividades y cómo puedo implementarlas en mis clases?', 
                'role_id' => 3, 
                'teacherId' => 202408170, 
                'created_at' => '2024-09-16 22:05:34', 
                'updated_at' => '2024-09-16 22:05:34'
            ],
            [
                'moduleId' => 14, 
                'title' => 'Programación accesible 1', 
                'description' => 'Paradigmas de la programación accesible y formas de implementarlas', 
                'role_id' => 4, 
                'teacherId' => 202408171, 
                'created_at' => '2024-09-16 22:05:56', 
                'updated_at' => '2024-09-16 22:05:56'
            ],
            [
                'moduleId' => 15, 
                'title' => 'Diseño web 1', 
                'description' => 'Diseñar los aplicativos de manera accesible', 
                'role_id' => 4, 
                'teacherId' => 202408174, 
                'created_at' => '2024-09-16 22:06:26', 
                'updated_at' => '2024-09-16 22:06:26'
            ],
            [
                'moduleId' => 16, 
                'title' => 'Accesibilidad general 1', 
                'description' => 'Implementación de accesibilidad en entornos móviles', 
                'role_id' => 4, 
                'teacherId' => 202408174, 
                'created_at' => '2024-09-16 22:07:07', 
                'updated_at' => '2024-09-16 22:07:07'
            ],
            [
                'moduleId' => 17, 
                'title' => 'React y accesibilidad', 
                'description' => 'Cómo puedo crear una API accesible?', 
                'role_id' => 4, 
                'teacherId' => 202408170, 
                'created_at' => '2024-09-16 22:07:28', 
                'updated_at' => '2024-09-16 22:07:28'
            ],
            [
                'moduleId' => 18, 
                'title' => 'Accesibilidad en Android', 
                'description' => 'Cómo puedo hacer mis aplicaciones Android más accesibles?', 
                'role_id' => 4, 
                'teacherId' => 202408171, 
                'created_at' => '2024-09-16 22:07:51', 
                'updated_at' => '2024-09-16 22:07:51'
            ],
            [
                'moduleId' => 19, 
                'title' => 'Accesibilidad en iOS', 
                'description' => 'Cómo puedo hacer mis aplicaciones iOS más accesibles?', 
                'role_id' => 4, 
                'teacherId' => 202408171, 
                'created_at' => '2024-09-16 22:08:13', 
                'updated_at' => '2024-09-16 22:08:13'
            ],
            [
                'moduleId' => 20, 
                'title' => 'Accesibilidad en Windows', 
                'description' => 'Cómo puedo hacer mis aplicaciones Windows más accesibles?', 
                'role_id' => 4, 
                'teacherId' => 202408171, 
                'created_at' => '2024-09-16 22:08:35', 
                'updated_at' => '2024-09-16 22:08:35'
            ],
            [
                'moduleId' => 21, 
                'title' => 'Accesibilidad en Linux', 
                'description' => 'Cómo puedo hacer mis aplicaciones Linux más accesibles?', 
                'role_id' => 4, 
                'teacherId' => 202408171, 
                'created_at' => '2024-09-16 22:08:58', 
                'updated_at' => '2024-09-16 22:08:58'
            ],
            [
                'moduleId' => 22, 
                'title' => 'Accesibilidad en MacOS', 
                'description' => 'Cómo puedo hacer mis aplicaciones MacOS más accesibles?', 
                'role_id' => 4, 
                'teacherId' => 202408171, 
                'created_at' => '2024-09-16 22:09:20', 
                'updated_at' => '2024-09-16 22:09:20'
            ],
        ]);
    }
}
