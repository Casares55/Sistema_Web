<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\CapturaImagen;
use App\Models\Embedding;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProcessEmbeddingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id_imagen;

    public function __construct($id_imagen)
    {
        $this->id_imagen = $id_imagen;
    }

    public function handle()
    {
        $captura = CapturaImagen::find($this->id_imagen);
        if (!$captura) return;

        // Leer archivo binario
        $path = str_replace('storage/', 'public/', $captura->ruta_imagen); // storage mapping
        $binary = Storage::get($path);

        // Llamada al microservicio Python (ejemplo)
        // Configura URL en .env: IA_SERVICE_URL=http://127.0.0.1:5000/embedding
        $res = Http::timeout(20)->post(config('app.ia_service_url', env('IA_SERVICE_URL')), [
            'image_base64' => base64_encode($binary),
            'id_imagen' => $captura->id_imagen
        ]);

        if ($res->ok()) {
            $vector = $res->json('vector'); // asume vector en array o string
            // Guardar embedding
            Embedding::create([
                'id_imagen' => $captura->id_imagen,
                'vector_embedding' => is_array($vector) ? json_encode($vector) : (string)$vector
            ]);
        } else {
            // opcional: log o reintento
            // throw new \Exception('IA service failed');
        }
    }
}
