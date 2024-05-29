<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegionController extends Controller
{
    public function fetchProvinsi(Request $request)
    {
        if (!auth()->check()) {
            abort(401, 'Unauthorized');
        }

        $token = json_decode(session('token'))->token;

        $response = Http::withToken($token)->get('https://gisapis.manpits.xyz/api/mregion');

        if ($response->successful()) {
            $provinsi = $response->json();
            return view('provinsi', compact('provinsi'));
        } else {
            $error = $response->json();
            return response()->json(['error' => $error['message']], $response->status());
        }
    }

    public function fetchKabupaten(Request $request, $provinceId)
    {
        if (!auth()->check()) {
            abort(401, 'Unauthorized');
        }

        $token = json_decode(session('token'))->token;

        $url = "https://gisapis.manpits.xyz/api/kabupaten/{$provinceId}";
        $response = Http::withToken($token)->get($url);

        if ($response->successful()) {
            $kabupaten = $response->json();
            return response()->json($kabupaten);
        } else {
            $error = $response->json();
            return response()->json(['error' => $error['message']], $response->status());
        }
    }

    public function fetchKecamatan(Request $request, $kabupatenId)
    {
        if (!auth()->check()) {
            abort(401, 'Unauthorized');
        }

        $token = json_decode(session('token'))->token;

        $url = "https://gisapis.manpits.xyz/api/kecamatan/{$kabupatenId}";
        $response = Http::withToken($token)->get($url);

        if ($response->successful()) {
            $kecamatan = $response->json();
            return response()->json($kecamatan);
        } else {
            $error = $response->json();
            return response()->json(['error' => $error['message']], $response->status());
        }
    }

    public function fetchDesa(Request $request, $kecamatanId)
    {
        if (!auth()->check()) {
            abort(401, 'Unauthorized');
        }

        $token = json_decode(session('token'))->token;

        $url = "https://gisapis.manpits.xyz/api/desa/{$kecamatanId}";
        $response = Http::withToken($token)->get($url);

        if ($response->successful()) {
            $desa = $response->json();
            return response()->json($desa);
        } else {
            $error = $response->json();
            return response()->json(['error' => $error['message']], $response->status());
        }
    }
}