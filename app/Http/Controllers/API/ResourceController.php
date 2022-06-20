<?php

namespace App\Http\Controllers\API;

use App\Models\Pdf;
use App\Models\Html;
use App\Models\Link;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPdfRequest;
use Illuminate\Support\Facades\File;
use App\Http\Requests\AddHtmlRequest;
use App\Http\Requests\AddLinkRequest;
use App\Http\Requests\EditPdfRequest;
use App\Http\Requests\EditHtmlRequest;
use App\Http\Requests\EditLinkRequest;
use App\Http\Requests\DownloadResourceRequest;

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

    public function handleDeleteResource($id)
    {
        $checkResource = Resource::find($id);
        if (!$checkResource) {
            return response()->json([
                'status' => false
            ], 404);
        }
        $checkResource->isPdf() ? File::delete(public_path('files/' . $checkResource->type->file)) : "";
        $checkResource->type()->delete();
        $checkResource->delete();
        return response()->json([
            'status' => true
        ], 200);
    }

    public function handleUpdateHtml(EditHtmlRequest $request)
    {
        $validatedData = $request->validated();
        $resource = Resource::with('type')->find($validatedData['id']);
        $resource->update([
            'title' => $validatedData['title']
        ]);

        $resource->type()->update([
            'description' => $validatedData['description'],
            'snippet' => $validatedData['snippet']
        ]);

        return response()->json([
            'status' => true
        ], 200);
    }

    public function handleUpdateLink(EditLinkRequest $request)
    {

        $validatedData = $request->validated();
        $resource = Resource::with('type')->find($validatedData['id']);
        $resource->update([
            'title' => $validatedData['title']
        ]);

        $resource->type()->update([
            'url' => $validatedData['url'],
            'open_tab' => $validatedData['open_tab']
        ]);

        return response()->json([
            'status' => true
        ], 200);
    }

    public function handleUpdatePdf(EditPdfRequest $request)
    {

        $validatedData = $request->validated();

        $resource = Resource::with('type')->find($validatedData['id']);

        $fileName = null;
        if ($validatedData['file']) {


            $file = $validatedData['file'];
            $fileName = time() . '.' . $file->extension();



            $file->move(public_path('files'), $fileName);
            File::delete(public_path('files/' . $resource->type->file));
        }

        $resource->update([
            'title' => $validatedData['title']
        ]);

        $resource->type()->update([
            'file' => $fileName ? $fileName : $request->type?->file,

        ]);
        return response()->json([
            'status' => true
        ], 200);
    }

    public function handleDownloadResource(DownloadResourceRequest $request)
    {
        $validatedData = $request->validated();

        $checkResource = Resource::find($validatedData['id']);
        if (!$checkResource->isPdf()) {
            return response()->json([
                "errors" => [
                    "resource" => ["The resource must be a file of type: PDF"]
                ]
            ], 422);
        }
        $path = public_path('files/' . $checkResource->type->file);

        return response()->download($path);
    }
}
