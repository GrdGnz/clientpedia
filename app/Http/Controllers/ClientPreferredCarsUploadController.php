<?php

namespace App\Http\Controllers;

use App\Models\ClientPreferredCarsUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ClientPreferredCarsUploadController extends Controller
{
    public function upload(Request $request, $clientId)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048', // Accepts Excel files
        ]);

        $file = $request->file('file');
        $timestamp = now()->format('YmdHis'); // Current timestamp in 'YYYYMMDDHHMMSS' format
        $fileName = 'preferred_cars_' . $timestamp . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads/preferred_cars/' . $clientId . '/', $fileName, 'public');

        $upload = new ClientPreferredCarsUpload();
        $upload->client_id = $clientId;
        $upload->file_path = $path;
        $upload->save();

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }

    public function showClientFiles($clientId)
    {
        $uploads = ClientPreferredCarsUpload::where('client_id', $clientId)->get();
        return view('your-view', compact('uploads', 'clientId'));
    }

    public function destroy($id)
    {
        try {
            $upload = ClientPreferredCarsUpload::findOrFail($id);
            $filePath = public_path($upload->file_path);

            // Check if the file exists
            if (File::exists($filePath)) {
                File::delete($filePath);
            } else {
                return redirect()->back()->with('error', 'File not found.');
            }

            // Delete the record from the database
            $upload->delete();

            return redirect()->back()->with('success', 'File deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Record not found.');
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the file.');
        }
    }
}
