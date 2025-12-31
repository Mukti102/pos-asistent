<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.settings.index');
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');

        foreach ($data as $key => $value) {
            // Jika input adalah file (logo/favicon)
            if ($request->hasFile($key)) {
                // Hapus foto lama jika ada
                $oldPath = Setting::get($key);
                if ($oldPath) Storage::disk('public')->delete($oldPath);

                // Simpan foto baru
                $value = $request->file($key)->store('settings', 'public');
            }

            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        FacadesAlert::toast('Pengaturan berhasil diperbarui!', 'success');

        return back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
