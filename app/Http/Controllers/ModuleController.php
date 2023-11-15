<?php

namespace App\Http\Controllers;

use App\Classes\Module;
use App\Classes\Zip;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $modules = Module::all();
        $ticketStatuses = TicketStatus::all();
        return view('Dashboard.Modules.index', compact('modules', 'ticketStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $request)
    {
        $ticketStatuses = TicketStatus::all();
        $type = $request->type;
        return view('Dashboard.Modules.create', compact('ticketStatuses', 'type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function delete(Request $request)
    {
        Module::find($request->name)->delete();
        return redirect()->route('dashboard.modules.allModules');
    }

    public function enable(Request $request)
    {
        Module::find($request->name)->enable();
        return back();
    }

    public function disable(Request $request)
    {
        Module::find($request->name)->disable();
        return back();
    }

    public function install(Request $request)
    {
        if( !isset($request->type) )
            Artisan::call('module:make ' . $request->name);
        else{
            // Get Uploaded File
            $request->validate([
                'module' => ['required', 'mimes:zip']
            ]);
            $file = $request->file('module');

            // Optional: Check file structure is same with Module structure
            $uploadedFile = new UploadedFile(storage_path('app') . DIRECTORY_SEPARATOR . Storage::disk('local')->allFiles('public')[1], 'module');
            $filesDoesNotExistInModule = Zip::check($file, $uploadedFile);
            if( $filesDoesNotExistInModule )
                return back()->withErrors(['not-exist' => $filesDoesNotExistInModule]);

            // Extract zip file to Modules directory
            Zip::extract($file, Module::getPath());

            // Enable Plugin
            Module::addToModulesStatuses(Zip::getName($file));
        }

        return redirect()->route('dashboard.modules.allModules');
    }
}
