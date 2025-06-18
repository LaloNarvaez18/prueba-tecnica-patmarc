<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Tecnología', 'description' => 'Productos tecnológicos'],
            ['name' => 'Hogar', 'description' => 'Artículos para el hogar'],
            ['name' => 'Electrodomésticos','description' => 'Equipos eléctricos'],
            ['name' => 'Ropa', 'description' => 'Prendas de vestir'],
            ['name' => 'Calzado', 'description' => 'Zapatos y botas'],
            ['name' => 'Libros', 'description' => 'Lecturas de todo tipo'],
            ['name' => 'Juguetes', 'description' => 'Para niños y niñas'],
            ['name' => 'Deportes', 'description' => 'Accesorios deportivos'],
            ['name' => 'Alimentos', 'description' => 'Comida y bebidas'],
            ['name' => 'Salud', 'description' => 'Cuidado personal'],
        ];

        foreach ($categories as $categorie) {
            Category::create([
                'name' => $categorie['name'],
                'description' => $categorie['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
