<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;
use App\Jobs\SendEmailJob;
use App\Models\AssignInquiry;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\AboutContent;
use App\Models\SubCategory;
use App\Models\SubChildCategory;
use App\Models\User;
use App\Models\ProductLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountActivationMail;
use App\Mail\NewsLetterEmail;
use Redirect;
use Response;
use App\Mail\ProductRejected;
use App\Models\Country;
use Str;
use Illuminate\Support\Facades\Storage;
use App\Models\BlogPost;
use App\Models\Membership;
use App\Models\MembershipOrder;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Image;
use Illuminate\Support\Facades\DB; // Import DB facade
class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                $products = Product::count();
                $vendors = User::where('role', 'supplier')->count();
                $buyers = User::where('role', 'buyer')->count();
                $members = Membership::count();
                $inquiry = Inquiry::count();
                $membersorder = MembershipOrder::where('status', 0)->count();
                $subscriber = Subscription::count();
                $blogcount = BlogPost::count();
                $blogs = BlogPost::orderBy('created_at', 'desc')->take(4)->get();
                return view('admin.index', compact('products', 'vendors', 'buyers', 'members', 'membersorder', 'inquiry', 'subscriber', 'blogcount', 'blogs'));
            }
            if (Auth::user()->role == 'supplier') {
                $products = Product::where('uid', Auth::user()->id)->count();
                $userId = Auth::user()->id;
                $productsCount = Product::where('uid', $userId)->count();
                if ($productsCount > 0) {
                    $inquiry = Inquiry::whereIn('product_id', function ($query) use ($userId) {
                        $query->select('id')->from('products')->where('uid', $userId);
                    })->count();
                } else {
                    $inquiry = 0;
                }
                $blogs = BlogPost::orderBy('created_at', 'desc')->take(4)->get();
                $user = User::where('id', Auth::user()->id)->with('membership')->first();
                return view('admin.index', compact('products', 'inquiry', 'blogs', 'user'));
            }
            if (Auth::user()->role == 'buyer') {
                $inquiry = Inquiry::where('cid', Auth::user()->id)->count();
                $blogs = BlogPost::orderBy('created_at', 'desc')->take(4)->get();
                $user = User::where('id', Auth::user()->id)->with('membership')->first();
                return view('admin.index', compact('inquiry', 'blogs', 'user'));
            }
        }
        return redirect('login');
    }
    //Categories
    public function categories()
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $categories = Category::all();
            return view('admin.categories', compact('categories'));
        } else {
            return redirect('login');
        }
    }
    //savecategory
    public function savecategory(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            $checkRecord = Category::where('id', $request->id)->first();

            // Create a slug based on the category name
            $slug = \Str::slug($request->category);

            if ($checkRecord) {
                // Update the category and slug
                $checkRecord->update([
                    'category' => trim($request->category),
                    'slug' => $slug,
                ]);
            } else {
                // Create a new category with the slug
                $Category = new Category([
                    'category' => trim($request->category),
                    'slug' => $slug,
                ]);
                $Category->save();
            }

            return redirect('categories')->with('success', 'Category has been Saved');
        } else {
            return redirect('login');
        }
    }

    //editcategory
    public function editcategory(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            $Category = Category::where('id', $request->categoryid)->first();
            return response()->json([
                'status' => true,
                'data' => $Category,
            ]);
        } else {
            return Redirect::to('login');
        }
    }
    //deletecategory
    public function deletecategory(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $Category = Category::where('id', $request->categoryid)->first();
            if ($Category) {
                $Category->delete();
                return response()->json(['success' => true]);
            }
        } else {
            return Redirect::to('login');
        }
    }

    //SubCategories
    public function subcategories()
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            $categories = Category::with('subcategories')->get();
            return view('admin.subcategories', compact('categories'));
        } else {
            return redirect('login');
        }
    }

    public function savesubcategory(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $checkRecord = SubCategory::where('id', $request->id)->first();

            // Create a slug based on the category name
            $slug = \Str::slug($request->subcategory);

            if ($checkRecord) {
                // Update the category and slug
                $checkRecord->update([
                    'category_id' => $request->category_id,
                    'subcategory' => trim($request->subcategory),
                    'slug' => $slug,
                ]);
            } else {
                // Create a new category with the slug
                $SubCategory = new SubCategory([
                    'category_id' => $request->category_id,
                    'subcategory' => trim($request->subcategory),
                    'slug' => $slug
                ]);
                $SubCategory->save();
            }

            return redirect('subcategories')->with('success', 'Sub Category has been Saved');
        } else {
            return redirect('login');
        }
    }
    //editsubcategory
    public function editsubcategory(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            $SubCategory = Category::where('id', $request->categoryid)->first();
            return response()->json([
                'status' => true,
                'data' => $SubCategory,
            ]);
        } else {
            return Redirect::to('login');
        }
    }
    //Delete Sub Category
    public function deletesubcategory(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $SubCategory = SubCategory::where('id', $request->categoryid)->first();
            if ($SubCategory) {
                $SubCategory->delete();
                return response()->json(['success' => true]);
            }
        } else {
            return Redirect::to('login');
        }
    }


    //subchildcategories
    public function subchildcategories()
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            $categories = Category::with('subcategories', 'subchildcategories')->get();
            return view('admin.subchildcategories', compact('categories'));
        } else {
            return redirect('login');
        }
    }
    //fetchsubcategories
    public function fetchsubcategories(Request $request)
    {
        $categoryId = $request->get('category_id');
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json(['subcategories' => $subcategories]);
    }
    //savechildcategory

    public function savechildcategory(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $checkRecord = SubChildCategory::where('id', $request->id)->first();

            // Create a slug based on the category name
            $slug = \Str::slug($request->subchildcategory);

            if ($checkRecord) {
                // Update the category and slug
                $checkRecord->update([
                    'category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'subchildcategory' => trim($request->subchildcategory),
                    'slug' => $slug,
                ]);
            } else {
                // Create a new category with the slug
                $SubChildCategory = new SubChildCategory([
                    'category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'subchildcategory' => trim($request->subchildcategory),
                    'slug' => $slug

                ]);
                $SubChildCategory->save();
            }
            return redirect('subchildcategories')->with('success', 'Sub Child Category has been Saved');
        } else {
            return redirect('login');
        }
    }
    //Delete Sub Child Category
    public function deletesubchildcategory(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $SubChildCategory = SubChildCategory::where('id', $request->subchildcategoryid)->first();
            if ($SubChildCategory) {
                $SubChildCategory->delete();
                return response()->json(['success' => true]);
            }
        } else {
            return Redirect::to('login');
        }
    }
    //Product
    public function products(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'buyer' || Auth::user()->role == 'supplier')) {
            if (Auth::user()->role == 'admin') {
                $products = Product::all();
            } else {
                $user = Auth::id();
                $products = Product::where('uid', $user)->with('user')->get();
                // $products = User::where('id', Auth::id())->with('products')->get();
            }
            return view('admin.products', compact('products'));
        } else {
            return Redirect::to('login');
        }
    }
    public function addproducts(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            $categories = Category::all();
            $currencies = Country::select('currency', DB::raw('COUNT(*) as country_count'))
                ->whereNotNull('currency')
                ->groupBy('currency')
                ->get();
            return view('admin.addproducts', compact('categories', 'currencies'));
        } else {
            return Redirect::to('login');
        }
    }
    //addproducts
    //getsubcategories
    public function getsubcategories(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            $subcategories = SubCategory::where('category_id', $request->category_id)->get();
            $sen['subcategories'] = $subcategories->toArray();
            return Response::json($sen);
        } else {
            return Redirect::to('login');
        }
    }

    //getsubchildcategories
    public function getsubchildcategories(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            $subchildcategories = SubChildCategory::where('sub_category_id', $request->subcategory_id)->get();
            $sen['subchildcategories'] = $subchildcategories->toArray();
            return Response::json($sen);
        } else {
            return Redirect::to('login');
        }
    }

    //saveproduct
    // public function saveproduct(Request $request)
    // {
    //     if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
    //         // Create a new product and save it
    //         $slug = \Str::slug($request->productname);
    //         $product = new Product([
    //             'category_id' => $request->input('category_id'),
    //             'sub_category_id' => $request->input('sub_category_id'),
    //             'sub_child_category_id' => $request->input('sub_child_category_id'),
    //             'productname' => $request->input('productname'),
    //             'description' => $request->input('description'),
    //             'tags' => serialize($request->input('tags')),
    //             'attribute' => serialize($request->input('attribute')),
    //             'details' => serialize($request->input('details')),
    //             'price_setting' => $request->input('price_setting'),
    //             'unit' => $request->input('unit'),
    //             'variablemoq' => serialize($request->input('variablemoq')),
    //             'variableprice' => serialize($request->input('variableprice')),
    //             'uniform_moq' => $request->input('uniform_moq'),
    //             'FOBprice' => $request->input('FOBprice'),
    //             'uniform_moq_min_price' => $request->input('uniform_moq_min_price'),
    //             'uniform_moq_max_price' => $request->input('uniform_moq_max_price'),
    //             'uid' => Auth::id(),
    //             'status' => (Auth::check() && Auth::user()->role == 'admin') ? 1 : 0,
    //             'slug'=>$slug
    //         ]);
    //         $product->save();
    //         // Decode the imageList JSON string into an array
    //         $imageList = json_decode($request->imageList);

    //         // Check if $imageList is an array before saving it
    //         if (is_array($imageList)) {
    //             foreach ($imageList as $imageData) {
    //                 // Extract the base64 image data from the "src" property
    //                 $base64Image = $imageData->src;

    //                 // Remove the "data:image/png;base64," prefix
    //                 $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);

    //                 // Decode the base64 image data
    //                 $imageData = base64_decode($base64Image);

    //                 // Load the watermark image
    //                 $watermarkPath = public_path('storage\product_images\watermark.png');

    //                 $watermark = Image::make($watermarkPath);

    //                 // Load the image from base64
    //                 $image = Image::make($imageData);

    //                 // Calculate the position for the watermark (center)
    //                 $positionX = ($image->width() - $watermark->width()) / 2;
    //                 $positionY = ($image->height() - $watermark->height()) / 2;

    //                 // Insert the watermark onto the image
    //                 $image->insert($watermark, 'top-left', $positionX, $positionY);

    //                 // Define the destination path and filename
    //                 $destinationPath = public_path('storage/product_images/');
    //                 $imagestore = date('YmdHis') . '_' . uniqid() . '.png'; // Use a unique name for each image

    //                 // Save the watermarked image to the destination path
    //                 $image->save($destinationPath . $imagestore);

    //                 // Assuming you have a "ProductImage" model for your database table
    //                 $productImage = new ProductImage();
    //                 $productImage->product_id = $product->id;
    //                 $productImage->images = $imagestore; // Store the image filename
    //                 $productImage->save();

    //                 // Now the image is saved to the directory with the watermark applied to the center, and its filename is stored in the database.
    //             }
    //         }

    //         if ($request->filled('video')) {
    //             $productImage = new ProductImage();
    //             $productImage->product_id = $product->id;
    //             $productImage->video = $request->input('video');
    //             $productImage->save();
    //         }
    //         if (Auth::check() && Auth::user()->role == 'admin') {
    //             return redirect()->back()->with('success', 'Product saved successfully.');
    //         } else {
    //             return redirect()->back()->with('success', 'The product has been saved successfully. You will be notified once it has been verified.');
    //         }
    //     } else {
    //         return redirect('login');
    //     }
    // }
    public function saveproduct(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            if ($request->product_id) {
                try {
                    DB::beginTransaction();
                    $slug = \Str::slug($request->productname);
                    $product = Product::find($request->product_id);
                    Product::where('id', $request->product_id)->update([
                        'category_id' => $request->input('category_id'),
                        'sub_category_id' => $request->input('sub_category_id'),
                        'sub_child_category_id' => $request->input('sub_child_category_id'),
                        'productname' => $request->input('productname'),
                        'description' => $request->input('description'),
                        'tags' => serialize($request->input('tags')),
                        'attribute' => serialize($request->input('attribute')),
                        'details' => serialize($request->input('details')),
                        'price_setting' => $request->input('price_setting'),
                        'unit' => $request->input('unit'),
                        'vendorname' => $request->input('vendorname'),
                        'variablemoq' => serialize($request->input('variablemoq')),
                        'variableprice' => serialize($request->input('variableprice')),
                        'uniform_moq' => $request->input('uniform_moq'),
                        'FOBprice' => $request->input('FOBprice'),
                        'uniform_moq_min_price' => $request->input('uniform_moq_min_price'),
                        'uniform_moq_max_price' => $request->input('uniform_moq_max_price'),
                        'slug' => $slug
                    ]);
                    // Fetch the ProductImage records to be deleted
                    if (!empty($request->deletelist)) {
                        $imagesToDelete = ProductImage::whereIn('id', $request->deletelist)->get();
                        // Loop through each image record
                        foreach ($imagesToDelete as $image) {
                            // Delete the image file from storage
                            Storage::delete('product_images/' . $image->images);

                            // Delete the record from the database
                            $image->delete();
                        }
                    }
                    // Decode the imageList JSON string into an array
                    $imageList = json_decode($request->imageList);

                    // Check if $imageList is an array before saving it
                    if (is_array($imageList)) {
                        foreach ($imageList as $imageData) {
                            // Extract the base64 image data from the "src" property
                            $base64Image = $imageData->src;

                            // Remove the "data:image/png;base64," prefix
                            $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);

                            // Decode the base64 image data
                            $imageData = base64_decode($base64Image);

                            // Load the watermark image
                            $watermarkPath = public_path('storage/product_images/watermark.png');

                            $watermark = Image::make($watermarkPath);

                            // Load the image from base64
                            $image = Image::make($imageData);

                            // Calculate the position for the watermark (center)
                            $positionX = ($image->width() - $watermark->width()) / 2;
                            $positionY = ($image->height() - $watermark->height()) / 2;

                            // Insert the watermark onto the image
                            $image->insert($watermark, 'top-left', $positionX, $positionY);

                            // Define the destination path and filename
                            $destinationPath = public_path('storage/product_images/');
                            $imagestore = date('YmdHis') . '_' . uniqid() . '.png'; // Use a unique name for each image

                            // Save the watermarked image to the destination path
                            $image->save($destinationPath . $imagestore);

                            // Assuming you have a "ProductImage" model for your database table
                            $productImage = new ProductImage();
                            $productImage->product_id = $product->id;
                            $productImage->images = $imagestore; // Store the image filename
                            $productImage->save();
                        }
                    }
                    if ($request->filled('video')) {
                        $vedio = ProductImage::where('product_id', $product->id)->where('video', '!=', 'null')->first();
                        if ($vedio) {
                            $vedio->video = $request->input('video');
                            $vedio->save();
                        } else {
                            $productImage = new ProductImage();
                            $productImage->product_id = $product->id;
                            $productImage->video = $request->input('video');
                            $productImage->save();
                        }
                    }

                    // Commit the database transaction
                    DB::commit();

                    if (Auth::check() && Auth::user()->role == 'admin') {
                        return redirect()->back()->with('success', 'Product Update successfully.');
                    } else {
                        return redirect()->back()->with('success', 'The product has been updated successfully. You will be notified once it has been verified.');
                    }
                } catch (\Exception $e) {
                    // If an error occurs, roll back the database transaction
                    DB::rollBack();

                    // Handle the error (e.g., log it, display a message to the user)
                    return redirect()->back()->with('error', 'Error occurred while saving the product: ' . $e->getMessage());
                }
            } else {
                try {
                    // Begin a database transaction
                    DB::beginTransaction();
                    $slug = \Str::slug($request->productname);
                    $product = new Product([
                        'category_id' => $request->input('category_id'),
                        'sub_category_id' => $request->input('sub_category_id'),
                        'sub_child_category_id' => $request->input('sub_child_category_id'),
                        'productname' => $request->input('productname'),
                        'description' => $request->input('description'),
                        'tags' => serialize($request->input('tags')),
                        'attribute' => serialize($request->input('attribute')),
                        'details' => serialize($request->input('details')),
                        'price_setting' => $request->input('price_setting'),
                        'unit' => $request->input('unit'),
                        'vendorname' => $request->input('vendorname'),
                        'variablemoq' => serialize($request->input('variablemoq')),
                        'variableprice' => serialize($request->input('variableprice')),
                        'uniform_moq' => $request->input('uniform_moq'),
                        'FOBprice' => $request->input('FOBprice'),
                        'uniform_moq_min_price' => $request->input('uniform_moq_min_price'),
                        'uniform_moq_max_price' => $request->input('uniform_moq_max_price'),
                        'uid' => Auth::id(),
                        'status' => (Auth::check() && Auth::user()->role == 'admin') ? 1 : 0,
                        'slug' => $slug
                    ]);
                    $product->save();

                    // Decode the imageList JSON string into an array
                    $imageList = json_decode($request->imageList);

                    // Check if $imageList is an array before saving it
                    if (is_array($imageList)) {
                        foreach ($imageList as $imageData) {
                            // Extract the base64 image data from the "src" property
                            $base64Image = $imageData->src;

                            // Remove the "data:image/png;base64," prefix
                            $base64Image = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);

                            // Decode the base64 image data
                            $imageData = base64_decode($base64Image);

                            // Load the watermark image
                            $watermarkPath = public_path('storage/product_images/watermark.png');

                            $watermark = Image::make($watermarkPath);

                            // Load the image from base64
                            $image = Image::make($imageData);

                            // Calculate the position for the watermark (center)
                            $positionX = ($image->width() - $watermark->width()) / 2;
                            $positionY = ($image->height() - $watermark->height()) / 2;

                            // Insert the watermark onto the image
                            $image->insert($watermark, 'top-left', $positionX, $positionY);

                            // Define the destination path and filename
                            $destinationPath = public_path('storage/product_images/');
                            $imagestore = date('YmdHis') . '_' . uniqid() . '.png'; // Use a unique name for each image

                            // Save the watermarked image to the destination path
                            $image->save($destinationPath . $imagestore);

                            // Assuming you have a "ProductImage" model for your database table
                            $productImage = new ProductImage();
                            $productImage->product_id = $product->id;
                            $productImage->images = $imagestore; // Store the image filename
                            $productImage->save();
                        }
                    }

                    if ($request->filled('video')) {
                        $productImage = new ProductImage();
                        $productImage->product_id = $product->id;
                        $productImage->video = $request->input('video');
                        $productImage->save();
                    }

                    // Commit the database transaction
                    DB::commit();

                    if (Auth::check() && Auth::user()->role == 'admin') {
                        return redirect()->back()->with('success', 'Product saved successfully.');
                    } else {
                        return redirect()->back()->with('success', 'The product has been saved successfully. You will be notified once it has been verified.');
                    }
                } catch (\Exception $e) {
                    // If an error occurs, roll back the database transaction
                    DB::rollBack();

                    // Handle the error (e.g., log it, display a message to the user)
                    return redirect()->back()->with('error', 'Error occurred while saving the product: ' . $e->getMessage());
                }
            }
        } else {
            return redirect('login');
        }
    }

    //maketopexport
    public function maketopexport(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $productId = $request->input('productId');
            $festured = $request->input('featured');
            try {
                $product = Product::findOrFail($productId);
                $product->featured = $festured;
                if ($product->status == 0) {
                    $product->status = 1;
                }
                $product->save();
                return response()->json(['message' => 'Status updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error updating status'], 500);
            }
        } else {
            return redirect('login');
        }
    }
    //product-details
    public function productdetails($id = null)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $products = Product::where('id', $id)->with('productImages')->first();

            return view('admin.product-details', compact('products'));
        } else {
            return redirect('login');
        }
    }
    //approveproduct
    public function approveproduct(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $checkproduct = Product::find($request->product_id);
            if ($checkproduct) {
                $checkproduct->status = 1;
                $checkproduct->save();
            } else {
                return response()->json(['message' => 'Product not found'], 404);
            }
            return response()->json(['message' => 'Product approved'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
    //rejectproduct
    public function rejectproduct(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $checkproduct = Product::find($request->productid);
            if ($checkproduct) {
                $checkproduct->status = 2;
                $checkproduct->featured = 0;
                $checkproduct->save();

                $ProductLog = new ProductLog([
                    'product_id' => $request->productid,
                    'reason' => $request->reason
                ]);
                $ProductLog->save();

                // Send email to the supplier
                $supplierEmail = $request->email; // Assuming you have a 'user' relationship in the 'Product' model
                Mail::to($supplierEmail)->send(new ProductRejected($checkproduct, $request->reason));

                return redirect('products')->with('success', 'Product Rejected and an email is sent to the supplier.');
            }
        }

        return redirect('login');
    }
    //subscribermanagerm
    public function SubscriberManagement(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $subscriber = Subscription::all();
            return view('admin.subscribermanagement', compact('subscriber'));
        } else {
            return redirect('login');
        }
    }
    //buyermanagement
    public function buyermanagement(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $users = User::where('role', 'buyer')->get();
            $type = 'buyer';
            return view('admin.usermanagement', compact('users', 'type'));
        } else {
            return redirect('login');
        }
    }
    //vendormanagement
    public function vendormanagement(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $users = User::where('role', 'supplier')->with('membership')->get();
            $type = 'supplier';
            return view('admin.usermanagement', compact('users', 'type'));
        } else {
            return redirect('login');
        }
    }
    //newsletter
    public function NewsLetter(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            return view('admin.newsletter');
        } else {
            return redirect('login');
        }
    }
    //send newsletters
    public function SendNewsLetter(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $subject = $request->subject;
            $message = $request->message;
            if ($request->subscriber || $request->buyer || $request->vendor) {
                if ($request->subscriber) {
                    $emails = Subscription::all()->pluck('email')->toArray();
                    dispatch(new SendEmailJob($emails, $subject, $message));
                }
                if ($request->buyer) {
                    $emails = User::all()->pluck('email')->toArray();
                    dispatch(new SendEmailJob($emails, $subject, $message));
                }
                if ($request->vendor) {
                    $emails = User::where('role', 'supplier')->pluck('email')->toArray();
                    dispatch(new SendEmailJob($emails, $subject, $message));
                }
            } else {
                return redirect()->back()->with('error', 'Please Choose at Least One..');
            }
            return redirect()->back()->with('success', 'Emails Send Successfully!!!');
        } else {
            return redirect('login');
        }
    }
    //download in excel
    public function DownloadExcel($type)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            if ($type == 'subscribe') {
                $users = Subscription::all();
                return Excel::download(new UsersExport($users, 'subscribe'), 'Subscribers.xlsx');
            } elseif ($type == 'supplier') {
                $users = User::where('role', 'supplier')->get();
                return Excel::download(new UsersExport($users, 'user'), 'Vendors.xlsx');
            } elseif ($type == 'buyer') {
                $users = User::where('role', 'buyer')->get();
                return Excel::download(new UsersExport($users, 'user'), 'Buyers.xlsx');
            }
        } else {
            return redirect('login');
        }
    }
    //updateuserstatus
    public function updateuserstatus(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $userId = $request->input('userId');
            $status = $request->input('status');
            try {
                $user = User::findOrFail($userId);
                $user->status = $status;
                $user->save();
                if ($status == 1) {
                    $activationLink = route('activate', ['user' => $user->id]);
                    // Queue the activation email
                    Mail::to($user->email)->queue(new AccountActivationMail($user, $activationLink));
                }
                return response()->json(['message' => 'Status updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error updating status'], 500);
            }
        } else {
            return redirect('login');
        }
    }
    public function activate(User $user)
    {
        // Perform activation logic here
        $user->status = 1;
        $user->save();

        // Redirect to a success page or perform additional actions
        return redirect('/login');
    }
    public function deleteProducts(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            // Retrieve the IDs of the products to be deleted
            $productIds = $request->input('productid');

            // Make sure productIds is an array
            if (!is_array($productIds)) {
                $productIds = [$productIds];
            }

            // Retrieve the products to be deleted
            $products = Product::whereIn('id', $productIds)->get();

            // Delete the products and related records
            foreach ($products as $product) {
                // Assuming related records are deleted automatically due to foreign key constraints
                $product->delete();
            }

            return redirect()->back()->with('success', 'Products and associated records have been deleted.');
        } else {
            return redirect()->to('login');
        }
    }

    //inquiries
    public function inquiries(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                // If the user is an admin, display all inquiries
                $inquiries = Inquiry::all();
            } elseif (Auth::user()->role == 'supplier') {
                // If the user is a supplier, display inquiries assigned to them
                $supplierId = Auth::user()->id;
                $assignedInquiries = AssignInquiry::where('sid', $supplierId)->get();
                // Get the inquiry IDs assigned to the supplier
                $inquiryIds = $assignedInquiries->pluck('inquiryid');

                // Retrieve only the inquiries assigned to the supplier
                $inquiries = Inquiry::whereIn('id', $inquiryIds)->get();
            } else {
                // For other roles, you can decide what to do (e.g., redirect or show a message)
                return redirect('login');
            }
            // Fetch the suppliers to be used in the view
            $suppliers = User::where('role', 'supplier')->get();

            return view('admin.inquiries', compact('inquiries', 'suppliers'));
        } else {
            return redirect('login');
        }
    }

    //
    public function assigninquiry(Request $request)
    {
        // Get the supplier ID and inquiry ID from the AJAX request
        $supplierId = $request->input('supplier_id');
        $inquiryId = $request->input('inquiry_id');

        // Store the data in the table (replace 'YourModel' with your actual model name)
        AssignInquiry::create([
            'sid' => $supplierId,
            'inquiryid' => $inquiryId,
        ]);

        // Return a response indicating success (You can customize the response if needed)
        return response()->json(['success' => true]);
    }
    //blogsettings
    public function blogsettings()
    {
        return view('admin.blogs.blogsettings');
    }
    public function blogauthors()
    {
        return view('admin.blogs.authors');
    }
    public function blogscategories()
    {
        return view('admin.blogs.categories');
    }
    //admin delete a product
    public function DeleteProduct($id)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $product = Product::where('id', $id)->first();
            $product->delete();
            return redirect()->back()->with('success', 'Product has been deleted.');
        } else {
            return redirect()->to('login');
        }
    }
    //admin/vendor Edit a product
    public function EditProduct($id)
    {
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'supplier')) {
            $product = Product::where('id', $id)->first();
            $categories = Category::all();
            $currencies = Country::select('currency', DB::raw('COUNT(*) as country_count'))
                ->whereNotNull('currency')
                ->groupBy('currency')
                ->get();
            $images = ProductImage::where('product_id', $id)->where('images', '!=', 'null')->get();
            $vedio = ProductImage::where('product_id', $id)->where('video', '!=', 'null')->first();
            $subcategory = SubCategory::where('id', $product->sub_category_id)->first();
            $childsub = SubChildCategory::where('id', $product->sub_child_category_id)->first();
            return view('admin.editproduct', compact('product', 'categories', 'currencies', 'subcategory', 'childsub', 'images', 'vedio'));
        } else {
            return redirect()->to('login');
        }
    }
    //edit Post
    public function EditPost($id)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $post = BlogPost::where('id', $id)->first();
            return view('admin.blogs.edit-post', compact('post'));
        } else {
            return redirect()->to('login');
        }
    }
    //post delete
    public function DeletePost($id)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $post = BlogPost::where('id', $id)->first();
            $post->delete();
            return back()->with('success', 'Post Delete Successfully..');
        } else {
            return redirect()->to('login');
        }
    }
    //postcreate/update
    public function postcreate(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            if ($request->input('post_id')) {
                $request->validate([
                    'post_title' => 'required',
                    'post_content' => 'required',
                    'post_category' => 'required|exists:blog_sub_categories,id',
                    'description' => 'required',
                ]);
                $post = BlogPost::where('id', $request->input('post_id'))->first();
                $checks = BlogPost::where('post_slug', Str::slug($request->post_title))
                    ->where('id', '!=', $post->id)
                    ->get();
                if ($checks->count() > 0) {
                    return response()->json(['code' => 3, 'msg' => 'Post title must be unique']);
                }
                if ($post) {
                    $post->author_id = Auth::id();
                    $post->category_id = $request->post_category;
                    $post->post_title = $request->post_title;
                    $post->description = $request->description;
                    $post->keywords = serialize($request->input('tags'));
                    $post->post_content = $request->post_content;
                    $post->post_slug = Str::slug($request->post_title);
                    if ($request->hasFile('featured_image')) {
                        $image = $request->file('featured_image');
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        $destinationPath = public_path('images/post_images');
                        $imagePath = $destinationPath . '/' . $imageName;
                        $thumbnailPath = $destinationPath . '/thumbnails'; // Create a thumbnails folder

                        // Create the thumbnails folder if it doesn't exist
                        if (!file_exists($thumbnailPath)) {
                            mkdir($thumbnailPath, 0755, true);
                        }

                        // Move the original image to the post_images folder
                        $upload = $image->move($destinationPath, $imageName);
                        // Open the image using Intervention Image
                        $image = Image::make($imagePath);
                        // Resize and save the first thumbnail (500x300)
                        $image->fit(500, 300)->save($thumbnailPath . '/thumbnail_500x300_' . $imageName);
                        // Re-open the original image (to start over for the second thumbnail)
                        $image = Image::make($imagePath);
                        // Resize and save the second thumbnail (200x200)
                        $image->fit(200, 200)->save($thumbnailPath . '/thumbnail_200x200_' . $imageName);

                        $post->featured_image = $imageName; // Store the image path
                    }
                    $saved = $post->save();
                    if ($saved) {
                        return response()->json(['code' => 1, 'msg' => 'Post Updated Successfully']);
                    } else {
                        return response()->json(['code' => 3, 'msg' => 'Something went wrong in updating post data']);
                    }
                }
            } else {
                $request->validate([
                    'post_title' => 'required|unique:blog_posts,post_title',
                    'post_content' => 'required',
                    'post_category' => 'required|exists:blog_sub_categories,id',
                    'featured_image' => 'required|mimes:jpeg,jpg,png|max:1024',
                ]);

                if ($request->hasFile('featured_image')) {
                    $image = $request->file('featured_image');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('images/post_images');
                    $imagePath = $destinationPath . '/' . $imageName;
                    $thumbnailPath = $destinationPath . '/thumbnails'; // Create a thumbnails folder

                    // Create the thumbnails folder if it doesn't exist
                    if (!file_exists($thumbnailPath)) {
                        mkdir($thumbnailPath, 0755, true);
                    }

                    // Move the original image to the post_images folder
                    $upload = $image->move($destinationPath, $imageName);
                    // Open the image using Intervention Image
                    $image = Image::make($imagePath);
                    // Resize and save the first thumbnail (500x300)
                    $image->fit(500, 300)->save($thumbnailPath . '/thumbnail_500x300_' . $imageName);
                    // Re-open the original image (to start over for the second thumbnail)
                    $image = Image::make($imagePath);
                    // Resize and save the second thumbnail (200x200)
                    $image->fit(200, 200)->save($thumbnailPath . '/thumbnail_200x200_' . $imageName);

                    if ($upload) {
                        $post = new BlogPost();
                        $post->author_id = Auth::id();
                        $post->category_id = $request->post_category;
                        $post->description = $request->description;
                        $post->keywords = serialize($request->input('tags'));
                        $post->post_title = $request->post_title;
                        $post->post_content = $request->post_content;
                        $post->post_slug = Str::slug($request->post_title);
                        $post->featured_image = $imageName; // Store the image path
                        $saved = $post->save();

                        if ($saved) {
                            return response()->json(['code' => 1, 'msg' => 'Post Successfully Saved']);
                        } else {
                            return response()->json(['code' => 3, 'msg' => 'Something went wrong in saving post data']);
                        }
                    } else {
                        return response()->json(['code' => 3, 'msg' => 'Something went wrong while uploading the featured image']);
                    }
                }
            }
        } else {
            return redirect()->to('login');
        }
    }
    //Adim Edit Page
    public function EditPage($string)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            if ($string == 'about') {
                $about = AboutContent::where('type', 'about')->first();
                return view('admin.editaboutpage', compact('about', 'string'));
            }
            if ($string == 'privacy') {
                $privacy = AboutContent::where('type', 'privacy')->first();
                return view('admin.editaboutpage', compact('privacy', 'string'));
            }
            if ($string == 'faq') {
                $faq = AboutContent::where('type', 'faq')->first();
                return view('admin.editaboutpage', compact('faq', 'string'));
            }
            if ($string == 'benefitbuyer') {
                $faq = AboutContent::where('type', 'benefitbuyer')->first();
                return view('admin.editaboutpage', compact('faq', 'string'));
            }
            if ($string == 'benefitsupplier') {
                $faq = AboutContent::where('type', 'benefitsupplier')->first();
                return view('admin.editaboutpage', compact('faq', 'string'));
            }
            if ($string == 'registerbuyer') {
                $faq = AboutContent::where('type', 'registerbuyer')->first();
                return view('admin.editaboutpage', compact('faq', 'string'));
            }
            if ($string == 'registersupplier') {
                $faq = AboutContent::where('type', 'registersupplier')->first();
                return view('admin.editaboutpage', compact('faq', 'string'));
            }
            if ($string == 'registerbuyer') {
                $faq = AboutContent::where('type', 'registersupplier')->first();
                return view('admin.editaboutpage', compact('faq', 'string'));
            }
            if ($string == 'inquirybuyer') {
                $faq = AboutContent::where('type', 'inquirybuyer')->first();
                return view('admin.editaboutpage', compact('faq', 'string'));
            }
        } else {
            return redirect()->to('login');
        }
    }
    //save about and privacy page
    public function SavePage(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $about = AboutContent::where('type', $request->type)->first();
            if ($about) {
                $about->update($request->all());
                return back()->with('success', 'Page successfully Updated...');
            } else {
                $newData = $request->all();
                $page = new AboutContent($newData);
                $page->save();
                return back()->with('success', 'Page successfully Added...');
            }
        } else {
            return redirect()->to('login');
        }
    }
    //ShowPaymentMethod
    public function MembershipPlanType(Request $request)
    {
        $type = $request->input('type');
        if (Auth::check() && (Auth::user()->role == 'supplier')) {
            if ($type) {
                $user_id = Auth::user()->id;
                $membership = new MembershipOrder();
                $membership->user_id = $user_id;
                switch ($type) {
                    case 'basic':
                        $membership->plan_type = 0;
                        $price = 299;
                        $membership->price = $price;
                        $plan = "Basic Listing";
                        break;

                    case 'enhanced':
                        $membership->plan_type = 1;
                        $price = 599;
                        $membership->price = $price;
                        $plan = "Enhanced Visibility";
                        break;

                    case 'premium':
                        $membership->plan_type = 2;
                        $price = 999;
                        $membership->price = $price;
                        $plan = "Premium Showcase";
                        break;

                    default:
                        break;
                }
                $membership->status = 0;
                $membership->save();

                return view('membership-thankyou', compact('plan', 'price'));
            } else {
                $membership = MembershipOrder::where('user_id', Auth::user()->id)->latest();
                if ($membership) {
                    $price = $membership->price;
                    if ($membership->plan_type == 0) {
                        $plan = "Basic Listing";
                    }
                    if ($membership->plan_type == 1) {
                        $plan = "Enhanced Visibility";
                    }
                    if ($membership->plan_type == 2) {
                        $plan = "Premium Showcase";
                    }
                    return view('membership-thankyou', compact('plan', 'price'));
                }
                return redirect()->route('membershipplan');
            }
        } else {
            return redirect('login');
        }
    }
    //Membershipmanage
    public function MembershipManagement(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $memberships = MembershipOrder::where('status', 0)->with('user')->get();
            return view('admin.membershipmanagement', compact('memberships'));
        } else {
            return redirect('login');
        }
    }
    //MembershipStatus
    public function MembershipStatus(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $membershipId = $request->input('membershipId');
            try {
                $membershiporder = MembershipOrder::findOrFail($membershipId);
                $user = User::findOrFail($membershiporder->user_id);
                $membership = Membership::where('user_id', $membershiporder->user_id)->first();
                if ($membership) {
                } else {
                    $membership = new Membership();
                }
                $membership->user_id = $membershiporder->user_id;
                $membership->price = $membershiporder->price;
                $membership->plan_type = $membershiporder->plan_type;
                $user->membership_id = $membershipId;
                $membershiporder->status = 1;
                $membership->status = 1;
                $membership->expire_at = now()->addYear();
                $user->save();
                $membership->save();
                $membershiporder->save();
                return response()->json(['message' => 'Status updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error updating status'], 500);
            }
        } else {
            return redirect('login');
        }
    }
    //freemembership
    public function FreeMembership(Request $request)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $userId = $request->input('userId');
            $value = $request->input('value');
            try {
                $user = User::findOrFail($userId);
                if ($user) {
                    $membership = Membership::where('user_id', $user->id)->first();
                    if ($membership) {
                    } else {
                        $membership = new Membership();
                    }
                    $membership->user_id = $user->id;
                    $membership->price = '0';
                    $membership->plan_type = 'free';
                    $membership->status = 1;
                    $membership->expire_at = now()->addYear();
                    $membership->save();
                    $user->membership_id = $membership->id;
                    $user->save();
                }
                return response()->json(['message' => 'Status updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error updating status'], 500);
            }
        } else {
            return redirect('login');
        }
    }
    //updateMembership
    public function UpdateMembership($user, $type)
    {
        if (Auth::check() && (Auth::user()->role == 'admin')) {
            $membership = Membership::where('user_id', $user)->first();
            if ($membership) {
                switch ($type) {
                    case '0':
                        $membership->plan_type = 0;
                        $price = 299;
                        $membership->price = $price;
                        $plan = "Basic Listing";
                        break;

                    case '1':
                        $membership->plan_type = 1;
                        $price = 599;
                        $membership->price = $price;
                        $plan = "Enhanced Visibility";
                        break;

                    case '2':
                        $membership->plan_type = 2;
                        $price = 999;
                        $membership->price = $price;
                        $plan = "Premium Showcase";
                        break;

                    default:
                        break;
                }
                $membership->status = 1;
                $membership->save();
            }
            return redirect()->back()->with('success', 'Membership Change Successfull');
        } else {
            return redirect('login');
        }
    }
}
