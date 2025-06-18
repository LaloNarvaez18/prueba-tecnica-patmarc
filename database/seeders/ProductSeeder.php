<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productNames = [
            'Smartphone Galaxy X20', 'Notebook ThinkPad 14"', 'Tablet Huawei', 'Audífonos Bluetooth JBL', 'Smartwatch Xiaomi',
            'Sábanas King Size', 'Cortinas blackout', 'Juego de loza', 'Mueble organizador', 'Lámpara de pie',
            'Refrigerador LG', 'Horno eléctrico 45L', 'Lavadora 15Kg', 'Batidora de pedestal', 'Cafetera Nespresso',
            'Polera básica hombre','Pantalón jogger mujer','Chaqueta impermeable','Camisa formal','Vestido floral',
            'Zapatillas deportivas', 'Botines cuero hombre', 'Sandalias planas mujer', 'Zapatos escolares negros', 'Zapatillas urbanas Adidas',
            'Cien años de soledad', 'El poder del ahora', 'Harry Potter y la piedra filosofal', 'Sapiens: De animales a dioses', 'Rebelión en la granja',
            'Lego Classic', 'Muñeca articulada', 'Auto a control remoto', 'Rompecabezas', 'Juego de cocina infantil',
            'Balón de fútbol', 'Bicicleta montaña', 'Ropa deportiva', 'Guantes de boxeo', 'Colchoneta yoga',
            'Café molido 250g', 'Mermelada de frutilla', 'Atún en agua 170g', 'Pasta integral 500g', 'Galletas sin azúcar 200g',
            'Termómetro digital', 'Suplemento vitamínico', 'Alcohol gel 500ml', 'Tensiómetro de brazo', 'Mascarillas KN95',
        ];

        $products = Product::factory(50)
            ->sequence(
                fn ($sequence) => [
                    'name' => $productNames[$sequence->index],
                ]
            )
            ->create();

        foreach ($products as $key => $product) {
            $categoryIndex = intdiv($key, 5) % 10;
            $categoryId = \App\Models\Category::skip($categoryIndex)->first()->id;
            $product->categories()->attach($categoryId);
        }
    }
}
