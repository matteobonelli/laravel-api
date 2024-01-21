<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence();
            $newProject = new Project();
            $newProject->user_id = 1;
            $newProject->title = $title;
            $newProject->description = $faker->text();
            $newProject->creation_date = $faker->dateTime();
            $newProject->image = ProjectSeeder::storeImage($faker->imageUrl(), $title);
            $newProject->slug = Str::slug($title, '-');
            $newProject->save();
        }
    }

    public static function storeImage($img, $name)
    {
        $url = $img;
        $contents = file_get_contents($url);
        $name = Str::slug($name, '-') . '.jpg';
        $path = 'images/' . $name;
        Storage::put('images/' . $name, $contents);
        return $path;
    }
}
