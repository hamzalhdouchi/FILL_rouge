<?php

namespace App\Http\Controllers;

use App\Models\Table;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;

class QRcodeController extends Controller
{
    public function generateQrCode($id)
    {
        $tableUrl = route('home.show',$id);

        $qrCode = base64_encode(QrCode::format('png')->size(300)->generate($tableUrl));
        
        return [
            'qrcode'=> $qrCode,
            'message'=> 'QR Codes generated and stored successfully!'
        ];
    }

    public function getQRcode($id)
    {
        $table = Table::findOrFail($id);

        if (!$table->qrCode) {
            return response()->json(['error' => 'QR code note found'],404);
        }

        return response()->json(
            [
                'id' => $table->id,
                'qr_code' => "data:image/png;base64".$table->qrCode,
            ]
            );
    }
}
