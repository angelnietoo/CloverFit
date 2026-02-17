<?php

namespace App\Http\Controllers;

use App\Models\Record; ///////
use App\Services\TelegramService;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    // Crear un registro
    public function store(Request $request)
    {
        $record = Record::create($request->all());
        $this->telegramService->notifyCreation($record); // Notificación por creación
        return response()->json($record);
    }

    // Eliminar un registro
    public function destroy($id)
    {
        $record = Record::findOrFail($id);
        $this->telegramService->notifyDeletion($record); // Notificación por borrado
        $record->delete();
        return response()->json('Registro eliminado');
    }
}
