<?php

namespace App\Http\Controllers\API;

use App\Models\Html;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddHtmlRequest;
use App\Http\Requests\AddLinkRequest;
use App\Http\Requests\AddPdfRequest;
use App\Models\Link;
use App\Models\Pdf;

class ResourceController extends Controller
{

    public function handleGetResources()
    {
        $resources = Resource::with('type')->paginate(10);
        return response()->json([
            'resources' => $resources
        ], 200);
    }
    public function handleSaveHtml(AddHtmlRequest $request)
    {
        $validatedData = $request->validated();
        $htmlResource = Html::create([
            'description' => $validatedData['description'],
            'snippet' => $validatedData['snippet']
        ]);
        $newResource = Resource::create([
            'title' => $validatedData['title']
        ]);
        $newResource->type()->associate($htmlResource)->save();


        return response()->json([
            'status' => true
        ], 200);
    }

    public function handleSaveLink(AddLinkRequest $request)
    {
        $validatedData = $request->validated();
        $linkResource = Link::create([
            'url' => $validatedData['url'],
            'open_tab' => $validatedData['open_tab'] ? 1 : 0
        ]);
        $newResource = Resource::create([
            'title' => $validatedData['title']
        ]);
        $newResource->type()->associate($linkResource)->save();


        return response()->json([
            'status' => true
        ], 200);
    }

    public function handleSavePdf(AddPdfRequest $request)
    {
        $validatedData = $request->validated();
        $file = $validatedData['file'];
        $fileName = time() . '.' . $file->extension();



        $file->move(public_path('files'), $fileName);

        $pdfResource = Pdf::create([
            'file' => $fileName,

        ]);

        $newResource = Resource::create([
            'title' => $validatedData['title']
        ]);
        $newResource->type()->associate($pdfResource)->save();

        return response()->json([
            'status' => true
        ], 200);
    }
}
