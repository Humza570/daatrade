@php
    $categories = App\Models\Category::with('subcategories.subchildcategories')
    ->where('slug', '!=', 'information-technology')
    ->get();

@endphp


<ul @if(Route::currentRouteName() == 'products.details' || Route::currentRouteName() == 'membershipplan') style="display: none" @else style="display: block"  @endif>
    @foreach ($categories as $category)
        <li>
            <a href="{{ route('categories.products', ['slug' => $category->slug]) }}">{{ $category->category }}</a>
            @if ($category->subcategories->count() > 0)
                <ul class="submenu">
                    @foreach ($category->subcategories as $subcategory)
                        <li>
                            <a  href="{{ route('categories.subcategory.products', ['categorySlug' => $category->slug, 'subcategorySlug' => $subcategory->slug]) }}">{{ $subcategory->subcategory }}</a>
                            @if ($subcategory->subchildcategories->count() > 0)
                                <ul class="subchildmenu">
                                    @foreach ($subcategory->subchildcategories as $subchildcategory)
                                        <li>
                                            <a href="{{ route('categories.subchildcategory.products', ['categorySlug' => $category->slug, 'subcategorySlug' => $subcategory->slug, 'subchildSlug' => $subchildcategory->slug]) }}">{{ $subchildcategory->subchildcategory }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.submenu li').hover(
            function() {
                $(this).find('.subchildmenu').css('display', 'block');
            },
            function() {
                $(this).find('.subchildmenu').css('display', 'none');
            }
        );
    });
</script>
