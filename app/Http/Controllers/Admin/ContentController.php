<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Content\CreateContentRequest;
use App\Http\Requests\Content\UpdateContentRequest;
use App\Models\Content\Content;
use App\Models\Content\Meta;
use App\UseCases\ContentService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContentController
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * ContentController constructor.
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    public function index(Request $request)
    {
        $content = Content::orderBy('date_from', 'desc')->paginate(25);

        return view('admin.content.index', compact('content'));
    }

    public function create(Request $request)
    {
        return view('admin.content.parts.create', compact('content'));
    }

    public function store(CreateContentRequest $request)
    {
        try{
            $meta = new Meta(Carbon::make($request->date_from), Carbon::make($request->date_to), $request->has('default'));

            if ($request->type === 'image'){
                $this->contentService->createImage($request->file('image'), $meta);
            }

            if ($request->type === 'video'){
                $this->contentService->createVideo($request->url, $meta);
            }
        }catch (\Exception $e){
            back()->with('errors', [$e->getMessage()]);
        }

        return back()->with('success','Content added successful');
    }

    public function edit(Content $content)
    {
        return view('admin.content.parts.edit', compact('content'));
    }

    public function update(Content $content, UpdateContentRequest $request)
    {
        $content->date_from = Carbon::make($request->date_from);
        $content->date_to = Carbon::make($request->date_to);
        $content->save();

        return redirect()->route('admin.content.index')->with('success','Content updated successful');
    }

    public function markDefault(Content $content, Request $request): void
    {
        $content->markAsDefault($request->has('default'));
    }

    public function markImmediate(Content $content, Request $request): void
    {
        $content->markImmediate($request->has('immediate'));
    }

    public function destroy(Content $content)
    {
        $this->contentService->delete($content->id);
    }
}