<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\LegalArea;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function Article()
    {
        return view('backend.articles',);
    }
    public function ArticleData(Request $request)
    {

        $accounts_customer_accounts = Article::orderBy('id', 'desc');


        $this->i = 1;

        return DataTables::of($accounts_customer_accounts)

            ->addColumn('id', function ($data) {
                return $this->i++;
            })
            ->addColumn('description', function ($data) {
                return Str::limit($data->description, 50);
            })

            ->addColumn('action', function ($data) {
                $htmlData = '';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-info btn-sm tableEdit"><i class="fa fa-edit"></i></a>';
                $htmlData .= '<a href="javascript:void(0)" data-id="' . $data->id . '" class="btn btn-danger btn-sm tableDelete"><i class="fa fa-trash"></i></a>';
                return $htmlData;
            })
            ->rawColumns(['description', 'address', 'action'])
            ->toJson();
    }
    public function ArticleInsert(Request $request)
    {

        if ($request->has('delete')) {
            $query = Article::find($request->delete);

            $query->delete();

            $message = 'Article Deleted Successfully!';
        } else {

            if ($request->has('id')) {
                $request->validate([
                    'title' => 'required',
                    'description' => 'required',
                    'legal_area_id' => 'required',
                    'date' => 'required',
                ]);
            } else {
                $request->validate(['title' => 'required',
                    'description' => 'required',
                    'legal_area_id' => 'required',
                    'date' => 'required',
                    'image' => 'required',
                ]);
            }

            $message = 'Article  Create Successfully!';

            try {
                DB::beginTransaction();

                if ($request->has('id')) {
                    $query = Article::find($request->id);
                    $message = 'Article Updated Successfully!';
                    $query->updated_by = Auth::id();
                    if (!$query) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Not Found, Please Try Again...',
                        ], 422);
                    }
                } else {
                    $query = new Article();
                }

                $query->title = $request->title;
                $query->about_us = $request->about_us;
                $query->date = $request->date;
                $query->quote = $request->quote;
                $query->status = $request->status;
                $query->description = $request->description;
                $query->second_description = $request->second_description;
                $query->tag_id = implode(',', $request->tag_id) ;
                $query->law_type_id = $request->law_type_id;
                $query->legal_area_id =implode(',', $request->legal_area_id)  ;
                $query->sub_legal_area_id =$request->sub_legal_area_id;



                $query->added_by = Auth::id();


                if ($request->file('image')) {
                    $file = $request->file('image');
                    $old_img = public_path('/image/Article' . $request->image);
                    if (file_exists($old_img)) {
                        @unlink($old_img);
                    }
                    $filenamefavicon = time() . $file->getClientOriginalName();
                    $file->move(public_path('/image/Article'),  $filenamefavicon);

                    $query->image = 'image/Article/' . $filenamefavicon;
                }

                $query->save();


                DB::commit();
            } catch (\Exception $e) {
                DB::rollback(); //Transaction rollback

                return response()->json([
                    'status' => 'error',
                    'message' => 'Server Error' . json_encode($e->errorInfo),
                ], 422);
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,

        ]);
    }
    public function ArticleEditData(Request $request)
    {
        $query = Article::find($request->id);

        if (!$query) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not Found, Please Try Again...',
            ], 422);
        }
        $legalAreas = LegalArea::whereIn('id', explode(',', $query->legal_area_id))->get(['id', 'name']);
        $tags = Tag::whereIn('id', explode(',', $query->tag_id))->get(['id', 'name']);
        return response()->json([
            'status' => 'success',
            'data' => $query,
            'tags' => $tags,
            'legal_areas' => $legalAreas,
            // 'legal_area_name' => $query->LegalArea ? $query->LegalArea->name : '',
            // 'tag_name' => $query->Tag ? $query->Tag->name : '',
        ]);
    }
    //like dislike




    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxLike(Request $request)
    {
        $post = Article::find($request->id);
        $response = auth()->user()->toggleLikeDislike($post->id, $request->like);

        return response()->json(['success' => $response]);
    }
    //end like dislike
}
