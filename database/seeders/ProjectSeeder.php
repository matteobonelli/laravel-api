<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
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
        $json = file_get_contents(__DIR__ . '/data/projects.json');
        $projects = json_decode($json, true);
        $technologies = Technology::all();

        foreach ($projects as $project) {
            $newProject = new Project();
            $newProject->user_id = 1;
            $newProject->title = $project['title'];
            $newProject->description = $project['description'];
            $newProject->link = $project['link'];
            $newProject->creation_date = $project['creation_date'];
            $newProject->slug = Str::slug($project['title'], '-');
            $newProject->image = ProjectSeeder::storeImage($project['title']);
            $newProject->category_id = $project['category_id'];

            $newProject->save();
            $newProject->technologies()->sync($project["technology_id"]);
        }
    }

    public static function storeImage($name)
    {
        $contents = file_get_contents(__DIR__ . '/images/' . $name . '.png');
        $name = Str::slug($name, '-') . '.png';
        $path = 'images/' . $name;
        Storage::put('public/images/' . $name, $contents);
        return $path;
    }
}
