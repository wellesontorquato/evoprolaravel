<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class EscanearMensagensSession extends Command
{
    protected $signature = 'scanner:sessions';
    protected $description = 'Escaneia arquivos Blade e PHP atrás de mensagens de session como session("success")';

    public function handle()
    {
        $caminhos = [
            resource_path('views'),
            app_path('Http/Controllers'),
        ];

        $padroes = [
            'session\(\s*[\'"]success[\'"]\s*\)',
            'session\(\)->has\(\s*[\'"]success[\'"]\s*\)',
            'session\(\s*\)->get\(\s*[\'"]success[\'"]\s*\)',
        ];

        $regex = '/' . implode('|', $padroes) . '/';

        foreach ($caminhos as $caminho) {
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($caminho));

            foreach ($iterator as $arquivo) {
                if ($arquivo->isFile() && preg_match('/\.(blade\.php|php)$/', $arquivo->getFilename())) {
                    $linhas = file($arquivo->getRealPath());

                    foreach ($linhas as $numero => $linha) {
                        if (preg_match($regex, $linha)) {
                            $this->warn("→ Encontrado em: {$arquivo->getRealPath()} (linha " . ($numero + 1) . ")");
                            $this->line(trim($linha));
                        }
                    }
                }
            }
        }

        $this->info('✅ Busca concluída.');
        return 0;
    }
}
