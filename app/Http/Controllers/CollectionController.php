<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CollectionController extends Controller
{
    public function collectionList()
    {
        $collection = Collection::all();
        return view('backend.pages.collection.collectionList', compact('collection'));
    }

    public function collectionForm()
    {
        $collections = Collection::all();
        return view('backend.pages.collection.collectionForm', compact('collections'));
    }

    public function submitCollectionForm(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'collection_name' => 'required',
            // 'category_image' => 'required',
            'status' => 'required',
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        //Store Data
        Collection::create([
            'collection_name' => $request->collection_name,
            'collection_image' => $request->collection_image,
            'status' => $request->status
        ]);
        notify()->success("Collection Added Successfully.");
        return redirect()->back();
    }

    // Edit
    public function collectionEdit($id)
    {
        $editCollection = Collection::find($id);
        return view('backend.pages.collection.editCollection', compact('editCollection'));
    }

    public function collectionUpadte(Request $request, $id)
    {
        $updateCollection = Collection::find($id);
        $updateCollection->update([
            'collection_name' => $request->collection_name,
            'collection_image' => $request->collection_image,
            'status' => $request->status
        ]);
        notify()->success("Update Successful.");
        return redirect()->route('admin.collection.list');
    }

    //Delete
    public function collectionDelete($id)
    {
        try {

            $deleteCategory = Collection::find($id);
            $deleteCategory->delete();

            notify()->success("Delete Successful.");
            return redirect()->back();
        } catch (Throwable $ex) {

            notify()->error("This Category Has Product, You Cannot Delete It");
            return redirect()->back();
        }
    }
}
