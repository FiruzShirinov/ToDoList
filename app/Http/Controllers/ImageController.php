<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use App\Http\Requests\ImageRequest;
use App\Traits\AjaxableTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    use AjaxableTrait;

    public function store(ImageRequest $request, ListItem $listItem)
    {
        if ($this->isAjaxRequest()) {
            $url = $this->saveImage($request);
            if ($listItem->image()->exists()) {
                $this->deleteImage($listItem->image->url);
                $listItem->image()->update(compact('url'));
            } else {
                $listItem->image()->create(compact('url'));
            }

            return $url;
        }
    }

    public function destroy(ListItem $listItem)
    {
        if ($this->isAjaxRequest()) {
            if ($listItem->image()->exists() && $this->deleteImage($listItem->image->url)){
                $listItem->image->delete();
                return true;
            }
            return false;
        }
    }

    private function saveImage($request): string
    {
        return Storage::putFile('public/images', $request->image);
    }

    private function deleteImage($url): bool
    {
        if (Storage::disk('local')->exists($url)) {
            return Storage::disk('local')->delete($url);
        }
        return false;
    }
}
