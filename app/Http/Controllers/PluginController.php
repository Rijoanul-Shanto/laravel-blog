<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Support\Facades\File;

class PluginController extends Controller
{
    public function index()
    {
        $plugins = Plugin::simplePaginate(5);
        return view('plugin.index', [
            'plugins' => $plugins,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pluginFile' => 'required|mimes:zip'
        ]);

        $fileName = $request->file('pluginFile')->getClientOriginalName();
        $fileName = $withOutExtension = pathinfo($fileName, PATHINFO_FILENAME);


        if (Plugin::where('user_id', '=', Auth::id())->first() && Plugin::where('name', '=', $fileName)->first()) {
            return back()->withErrors(['status', 'Plugin Already Exists']);;
        }

        $request->user()->plugins()->create([
            'name' => $fileName,
        ]);

        $zip = new \ZipArchive;

        if ($zip->open($request->file('pluginFile'))) {
            $zip->extractTo(base_path("plugins"));
            $zip->close();
        }

        return redirect()->route('plugins')->with('status', 'Plugin Installed!');
    }

    public function destroy(Request $request, Plugin $plugin)
    {
        $plugin_path = "plugins/" . $plugin->name;

        $file_path = base_path($plugin_path);

        if (File::exists($file_path)) {
            File::deleteDirectory($file_path);

            $plugin->delete();

            return back()->with('status', 'Plugin Uninstalled!');
        }

        return back()->with('status', 'Plugin not Uninstalled!');
    }
}
