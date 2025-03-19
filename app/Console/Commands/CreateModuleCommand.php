<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateModuleCommand extends Command
{
    protected $signature = 'create:module {name}';
    protected $description = 'Create a new module with specified directories and files';

    public function handle()
    {
        $moduleName = Str::studly($this->argument('name')); // Converts input to PascalCase
        $this->createDirectories($moduleName);
        $this->createFiles($moduleName);

        $this->info("Module '{$moduleName}' created successfully!");
    }

    private function createDirectories($moduleName)
    {
        $directories = [
            'Services',
            'Repositories',
            'Requests',
            'Controllers',
            'Resources',
            'Models',
        ];

        $basePath = app_path("Http/{$moduleName}");

        if (!File::exists($basePath)) {
            File::makeDirectory($basePath, 0755, true);
        }

        foreach ($directories as $directory) {
            $path = "{$basePath}/{$directory}";
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }
    }

    private function createFiles($moduleName)
    {
        $files = [
            'Service' => "Services/{$moduleName}Service.php",
            'Repository' => "Repositories/{$moduleName}Repository.php",
            'Request' => "Requests/{$moduleName}Request.php",
            'Controller' => "Controllers/{$moduleName}Controller.php",
            'Resource' => "Resources/{$moduleName}Resource.php",
            'Model' => "Models/{$moduleName}.php", // Ensuring the model is created as `Country.php`, not `CountryModel.php`
        ];

        foreach ($files as $stubName => $filePath) {
            $stub = $this->getStubContent($stubName, $moduleName);
            $fullPath = app_path("Http/{$moduleName}/{$filePath}");

            File::put($fullPath, $stub);
        }
    }

    private function getStubContent($stubName, $moduleName)
    {
        $stubPath = resource_path("stubs/{$stubName}.stub");

        if (!File::exists($stubPath)) {
            $this->error("Stub file missing: {$stubPath}");
            return "<?php\n\n// Auto-generated file for {$moduleName} {$stubName}";
        }

        $stub = File::get($stubPath);

        // Replace placeholders
        return str_replace(
            ['{{name}}', '{{nameLower}}'],
            [$moduleName, strtolower($moduleName)],
            $stub
        );
    }
}
