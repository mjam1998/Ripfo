<?php

namespace App\Http\Controllers;

use App\Enums\ArticleStatus;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WriterController extends Controller
{
    public function index(){
        return view('panel.writer.index');
    }
    public function article(){
        $jurors = User::role('juror')
            ->where('id', '!=', auth()->id())
            ->get();
        $writers= User::role('writer')
            ->where('id', '!=', auth()->id())
            ->get();
        return view('panel.writer.article', compact('jurors', 'writers'));
    }
    public function articleStore(StoreArticleRequest $request){
        $writers = $request->input('writers_id');




        $jurorOfferName=null;
        $jurorOfferId=null;
        $code=null;
        if($request['juror_offer_id']==0 && $request->filled('juror_offer_name')){
            $jurorOfferName=$request['juror_offer_name'];
        }
        if($request['juror_offer_id']>=1){
            $jurorOfferId=$request['juror_offer_id'];
        }
        do {
            $code = strtolower(Str::random(6));
        } while (Article::where('code', $code)->exists());

        $filePrimaryExtension=$request->file_primary->getClientOriginalExtension();
        $filePrimaryName=$code.".".$filePrimaryExtension;
        $request->file_primary->storeAs('articles', $filePrimaryName, 'public');
        $fileSecondaryName=null;
        if ($request->hasFile('file_secondary')) {
            $fileSecondaryExtension=$request->file_secondary->getClientOriginalExtension();
            $fileSecondaryName=$code.".".$fileSecondaryExtension;
            $request->file_secondary->storeAs('attachments', $fileSecondaryName, 'public');
        }
         $article=Article::query()->create([
            'juror_offer_id'=>$jurorOfferId,
             'code'=>$code,
             'title'=>$request['title'],
             'title_en'=>$request['title_en'],
             'summary'=>$request['summary'],
             'summary_en'=>$request['summary_en'],
             'file_primary'=>$filePrimaryName,
             'file_secondary'=>$fileSecondaryName,
             'status'=>ArticleStatus::SendedReview,

         ]);
        if (is_array($writers) && count($writers) > 0) {
            $writers = array_merge($writers, [auth()->user()->id]);
            $article->users()->attach($writers);
        }

        return redirect()->back()->with('article_success','مقاله با موفقیت درج شد.');
    }
}
