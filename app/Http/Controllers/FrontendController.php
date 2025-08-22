<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Article;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\Experience;
use App\Models\FaqCategory;
use App\Models\LawCategory;
use App\Models\LegalArea;
use App\Models\Reputation;
use App\Models\Slot;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FrontendController extends Controller
{
    public function Home(Request $request)
    {
        $banners = Banner::where('status', 'Active')->get();
        $Reputations = Reputation::where('status', 'Active')->get();
        $Experiences = Experience::where('status', 'Active')->get();
        $Testimonials = Testimonial::where('status', 'Active')->get();
        $LegalAreas = LegalArea::where('status', 'Active')->take(12)->get()->chunk(4);
        $Teams = Team::where('status', 'Active')->get();
        $Articles = Article::where('status', 'Active')->take(3)->get();

        $categories = LawCategory::with('LegalArea')->get();
        //dd($categories->shift()->LegalArea);
        $firstCategory = $categories->shift(); // This will remove and return the first category
        $remainingCategories = $categories;
        return view('frontend.home', compact('banners', 'Reputations', 'Experiences', 'Testimonials', 'LegalAreas', 'Teams', 'Articles', 'firstCategory', 'remainingCategories'));
    }
    public function AboutUs(Request $request)
    {
        return view('frontend.about_us', [
            'Teams' => Team::where('status', 'Active')->get(),
            'abouts' => AboutUs::where('status', 'Active')->first(),
            'Experiences' => Experience::where('status', 'Active')->get(),
        ]);
    }
    public function OurTeam(Request $request)
    {
        return view('frontend.our_team', [
            'teams' => Team::where('status', 'Active')->get(),
        ]);
    }
    public function TeamDetails(Request $request)
    {
    
        return view('frontend.team_details', [
            'team' => Team::find($request->id),
        ]);
    }
    public function Faq(Request $request)
    {
        $categories = FaqCategory::with('faqs')->get();

        $firstCategory = $categories->shift(); // This will remove and return the first category


        $remainingCategories = $categories;
        return view('frontend.faq', [
            'firstCategory' => $firstCategory,
            'remainingCategories' => $remainingCategories,

        ]);
    }
    public function Articles(Request $request)
    {

        return view('frontend.articles', [
            'Articles' => Article::where('status', 'Active')->paginate(12),
        ]);
    }
    public function ArticlesByLegalArea(Request $request)
    {
        $Articles = Article::where('status', 'Active')->whereRaw('FIND_IN_SET(?, legal_area_id)', [(int)$request->id])->paginate(12);
        return view('frontend.articles', compact('Articles'));
    }
    public function ArticlesByTag(Request $request)
    {
        $Articles = Article::where('status', 'Active')->where('tag_id', (int)$request->id)->paginate(12);
        return view('frontend.articles', compact('Articles'));
    }
    public function ContactUs(Request $request)
    {
        return view('frontend.contact_us', [
            'ContactUs' => ContactUs::where('status', 'Active')->get(),
        ]);
    }
    public function MakeAppointment(Request $request)
    {
        return view('frontend.make_appointment', [
            'ContactUs' => ContactUs::where('status', 'Active')->get(),
        ]);
    }
    function SlotGet(Request $request)
    {
        if ($request->ajax()) {
            if ($request->date) {
                $date =   Carbon::parse($request->date)->dayName;
                $slots = Slot::where('day', $date)->get();

            } else {
                $slots = [];
            }

            return view('frontend.slot_data', compact('slots'))->render();
        }
    }
    public function practiceArea(Request $request)
    {
        if ($request->id) {
            $LegalAreas = LegalArea::where('status', 'Active')->where('law_category_id', $request->id)->paginate(12);
        }
        else{
            $LegalAreas = LegalArea::where('status', 'Active')->paginate(12);
        }

        return view('frontend.practice_area', compact('LegalAreas'));
    }
    public function ArticlesDetails(Request $request)
    {
        $article = Article::find($request->id);
        $articles = Article::where('status', 'Active')->latest()->take(6)->get();
        $tags = Tag::whereIn('id', explode(',', $article->tag_id))->get(['id', 'name']);
        return view('frontend.article_details', compact('article', 'tags', 'articles'));
    }
}
