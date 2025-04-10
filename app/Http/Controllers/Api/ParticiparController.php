<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\QRCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ParticiparController extends Controller
{
    public function enviarQR(Request $request)
    {
        $qrCode = $request->input('qrCode');
        $evento = $request->input('evento');
        $usuarioEmail = $request->input('email');

        if (!$qrCode || !$evento || !$usuarioEmail) {
            return response()->json(['error' => 'Datos incompletos.'], 400);
        }

        try {
            Mail::to($usuarioEmail)->send(new QRCodeMail($qrCode, $evento));
            return response()->json(['message' => 'Correo enviado con éxito.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al enviar el correo: ' . $e->getMessage()], 500);
        }
    }
}
