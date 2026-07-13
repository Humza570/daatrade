<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use App\Models\BlogPost;
use App\Models\BlogSubCategory;
use App\Models\Category;
use App\Models\City;
use App\Models\Subscription;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubChildCategory;
use Auth;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Response;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\SEOTools;

class CustomerController extends Controller
{
    public function index()
    {
        $products = Product::where('category_id',3)->where('status', 1)->orderBy('created_at', 'desc')->with('user')->get();
        $categories = Category::all();
        $topproducts = Product::where(
            [
                'featured' => 1,
                'status' => 1,
            ]
        )->orderBy('created_at', 'desc')->get();
        return view('index', compact('topproducts', 'categories', 'products'));
    }
    //Searchfunction
    public function Search(Request $request)
    {
        $string = $request->search;
        $products = Product::where('productname', 'like', "%$string%")->where('status', 1)->with('user')->get();
        $productscount = count($products);
        $categories = Category::all();
        return view('showProducts', compact('categories', 'products', 'productscount'));
    }
    //showProducts
    public function showProducts($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $products = $category->products()->where('status', 1)->with('user')->get();
            $productscount = count($products);
            $categories = Category::all();
            SEOMeta::setTitle($category->category);
            SEOMeta::setDescription($category->category);
            SEOMeta::addMeta('article:published_time', $category->created_at->toW3CString(), 'property');
            SEOMeta::addKeyword($category->category);

            OpenGraph::setDescription($category->category);
            OpenGraph::setTitle($category->category);
            OpenGraph::setUrl('https://daatrade.com/' . $slug);
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('locale', 'pt-br');
            OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
            OpenGraph::addImage('https://daatrade.com/assets/img/logo.png');
            JsonLd::addImage('https://daatrade.com/assets/img/logo.png');
            JsonLd::setTitle($category->category);
            JsonLd::setDescription($category->category);
            JsonLd::setType('Article');
            return view('showProducts', compact('categories', 'products', 'productscount'));
        }
        abort(404);
    }
    public function showSubcategoryProducts($categorySlug, $subcategorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();
        $subcategory = SubCategory::where('slug', $subcategorySlug)->first();

        if ($category && $subcategory) {
            $products = Product::where('sub_category_id', $subcategory->id)->where('status', 1)->with('user')->get();
            $productscount = count($products);
            $categories = Category::all();
            SEOMeta::setTitle($subcategory->subcategory);
            SEOMeta::setDescription($subcategory->subcategory);
            SEOMeta::addMeta('article:published_time', $subcategory->created_at->toW3CString(), 'property');
            SEOMeta::addKeyword($subcategory->subcategory);

            OpenGraph::setDescription($subcategory->subcategory);
            OpenGraph::setTitle($subcategory->subcategory);
            OpenGraph::setUrl('https://daatrade.com/' . $categorySlug . '/' . $subcategorySlug);
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('locale', 'pt-br');
            OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
            OpenGraph::addImage('https://daatrade.com/assets/img/logo.png');
            JsonLd::addImage('https://daatrade.com/assets/img/logo.png');
            JsonLd::setTitle($subcategory->subcategory);
            JsonLd::setDescription($subcategory->subcategory);
            JsonLd::setType('Article');
            return view('showProducts', compact('categories', 'products', 'productscount'));
        }
        abort(404);
    }
    public function showSubchildCategoryProducts($categorySlug, $subcategorySlug, $subchildSlug)
    {
        // Find the category, subcategory, and subchild category by their respective slugs
        $category = Category::where('slug', $categorySlug)->first();
        $subcategory = SubCategory::where('slug', $subcategorySlug)->first();
        $subchildcategory = SubChildCategory::where('slug', $subchildSlug)->first();

        if ($category && $subcategory && $subchildcategory) {
            // Fetch products based on the subchild category
            $products = Product::where('sub_child_category_id', $subchildcategory->id)->where('status', 1)->with('user')->get();
            $productscount = count($products);
            $categories = Category::all();
            SEOMeta::setTitle($subchildcategory->subchildcategory);
            SEOMeta::setDescription($subchildcategory->subchildcategory);
            SEOMeta::addMeta('article:published_time', $subchildcategory->created_at->toW3CString(), 'property');
            SEOMeta::addKeyword($subchildcategory->subchildcategory);

            OpenGraph::setDescription($subcategory->subcategory);
            OpenGraph::setTitle($subchildcategory->subchildcategory);
            OpenGraph::setUrl('https://daatrade.com/' . $categorySlug . '/' . $subcategorySlug . '/' . $subchildSlug);
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('locale', 'pt-br');
            OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
            OpenGraph::addImage('https://daatrade.com/assets/img/logo.png');
            JsonLd::addImage('https://daatrade.com/assets/img/logo.png');
            JsonLd::setTitle($subchildcategory->subchildcategory);
            JsonLd::setDescription($subcategory->subcategory);
            JsonLd::setType('Article');
            return view('showProducts', compact('categories', 'products', 'productscount'));
        }
        abort(404);
    }
    //ProductsDetails
    public function productsDetails($slug)
    {
        $products = Product::where('status', 1)
            ->where('slug', $slug) // 'slug' field ka istemal karke product ko dhundhein
            ->with('productImages')
            ->firstOrFail();
        $categories = Category::all();
        $products->attribute = unserialize($products->attribute);
        $products->details = unserialize($products->details);

        $variablemoq = null;
        $variableprice = null;
        $uniform_moq = null;
        $FOBprice = null;
        $uniform_moq_min_price = null;
        $uniform_moq_max_price = null;

        if ($products->price_setting === 'variable') {
            $variablemoq = unserialize($products->variablemoq);
            $variableprice = unserialize($products->variableprice);
        } elseif ($products->price_setting === 'uniform') {
            $uniform_moq = $products->uniform_moq;
            $FOBprice = $products->FOBprice;
            $uniform_moq_min_price = $products->uniform_moq_min_price;
            $uniform_moq_max_price = $products->uniform_moq_max_price;
        }
        SEOMeta::setTitle($products->productname);
        SEOMeta::setDescription($products->productname);
        SEOMeta::addMeta('article:published_time', $products->created_at->toW3CString(), 'property');
        $keywordsArray = unserialize($products->tags);
        SEOMeta::addKeyword($keywordsArray);

        OpenGraph::setDescription($products->productname);
        OpenGraph::setTitle($products->productname);
        OpenGraph::setUrl('https://daatrade.com/' . $slug);
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
        OpenGraph::addImage('https://daatrade.com/assets/img/logo.png');
        JsonLd::addImage('https://daatrade.com/assets/img/logo.png');
        JsonLd::setTitle($products->productname);
        JsonLd::setDescription($products->productname);
        JsonLd::setType('Article');
        return view('product-details', compact('categories', 'products', 'variablemoq', 'variableprice', 'uniform_moq', 'FOBprice', 'uniform_moq_min_price', 'uniform_moq_max_price'));
    }

    //getcities
    public function getcities(Request $request)
    {
        $getcontactcities = City::where(['country_id' => $request->countryid])->get();
        $sen['getcontactcities'] = $getcontactcities->toArray();
        return Response::json($sen);
    }
    //inquiry
    public function inquiry(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'buyer')) {
            $request->validate([
                'subject' => 'required',
                'quantity' => 'required|numeric',
                'message' => 'required',
            ]);
            $inquiry = new Inquiry();
            $inquiry->product_id = $request->input('product_id');
            $inquiry->cid = Auth::id();
            $inquiry->subject = $request->input('subject');
            $inquiry->quantity = $request->input('quantity');
            $inquiry->message = $request->input('message');
            $inquiry->save();
            return redirect()->back()->with('success', 'Inquiry submitted successfully!')->with('sweetAlert', true);
        } else {
            return redirect('login');
        }
    }
    //about page
    public function about()
    {
        $about = AboutContent::where('type', 'about')->first();
        return view('about', compact('about'));
    }

    //Buyer/Supplier Benefits page
    public function BenefitPage($type)
    {
        if($type=='benefitbuyer')
        {
            $data = AboutContent::where('type', 'benefitbuyer')->first();
            return view('benefitspage', compact('data','type'));
        }elseif($type=='benefitsupplier')
        {
            $data = AboutContent::where('type', 'benefitsupplier')->first();
            return view('benefitspage', compact('data','type'));
        }
        abort(404);
    }
    //How to register page
    public function HowRegisterPage($type)
    {
        if($type=='registerbuyer')
        {
            $data = AboutContent::where('type', 'registerbuyer')->first();
            return view('howtoregister', compact('data','type'));
        }elseif($type=='registersupplier')
        {
            $data = AboutContent::where('type', 'registersupplier')->first();
            return view('howtoregister', compact('data','type'));
        }
        abort(404);
    }
    //Buyer Inquire page
    public function BuyerInquire()
    {
        $data = AboutContent::where('type', 'inquirybuyer')->first();
        return view('buyerinquirepage', compact('data'));
    }
    //contact page
    public function contact()
    {
        return view('contact');
    }
    //FAQ page
    public function FAQ()
    {
        $faq = AboutContent::where('type', 'faq')->first();
        return view('faq', compact('faq'));
    }
    //privacy page
    public function privacy()
    {
        $privacy = AboutContent::where('type', 'privacy')->first();
        return view('privacy', compact('privacy'));
    }
    public function blogs(Request $request)
    {
        $blogCategories = BlogSubCategory::with('posts')->get();
        $blogs = BlogPost::all();
        return view('blog', compact('blogCategories', 'blogs'));
    }
    public function blogDetails(Request $request, $slug)
    {
        $blogCategories = BlogSubCategory::with('posts')->get();
        $blogs = BlogPost::where('post_slug', $slug)->get();
        $blog = BlogPost::where('post_slug', $slug)->first();
        $sec = BlogSubCategory::where('id', $blog->category_id)->first();
        SEOMeta::setTitle($blog->title);
        SEOMeta::setDescription($blog->description);
        SEOMeta::addMeta('article:published_time', $blog->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $sec->subcategory_name, 'property');
        $keywordsArray = unserialize($blog->keywords);
        SEOMeta::addKeyword($keywordsArray);

        OpenGraph::setDescription($blog->description);
        OpenGraph::setTitle($blog->title);
        OpenGraph::setUrl('https://daatrade.com/' . $slug);
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'pt-br');
        OpenGraph::addProperty('locale:alternate', ['pt-pt', 'en-us']);
        OpenGraph::addImage(asset('images/post_images/thumbnails/thumbnail_200x200_' . $blog->featured_image));

        JsonLd::setTitle($blog->title);
        JsonLd::setDescription($blog->description);
        JsonLd::setType('Article');
        JsonLd::addImage(asset('images/post_images/thumbnails/thumbnail_200x200_' . $blog->featured_image));
        return view('blog-details', compact('blogCategories', 'blogs'));
    }
    //save subscribe data
    public function Subscribe(Request $request)
    {
        $check = Subscription::where('email', $request->email)->first();
        if ($check) {
            return redirect()->back()->with('error', 'You Already Subscribed with this Email...');
        } else {
            $subscribe = new Subscription();
            $subscribe->name = $request->name;
            $subscribe->email = $request->email;
            $subscribe->country = $request->country;
            $subscribe->save();
            return redirect()->back()->with('success', 'Subscribed Successfully...');
        }
    }
    //blogs
    public function blogsearch(Request $request)
    {
        $query = $request->input('query');
        $blogs = BlogPost::where('post_title', 'like', "%$query%")
            ->orWhere('post_content', 'like', "%$query%")
            ->get();
        $blogCategories = BlogSubCategory::with('posts')->get();
        // Get the most recent 5 blog posts
        $recentBlogs = BlogPost::latest()->take(5)->get();
        return view('blog', compact('blogCategories', 'blogs', 'recentBlogs'));
    }
    public function CatBlog($slug)
    {
        $cat=BlogSubCategory::where('slug',$slug)->first();
        $blogCategories = BlogSubCategory::with('posts')->get();
        $blogs = BlogPost::where('category_id', $cat->id)->get();
        // Get the most recent 5 blog posts
        $recentBlogs = BlogPost::latest()->take(5)->get();
        return view('blog', compact('blogCategories', 'blogs', 'recentBlogs'));
    }
    //membership plan view
    public function MembershipPlan()
    {
        return view('membershipplan');
    }
}
