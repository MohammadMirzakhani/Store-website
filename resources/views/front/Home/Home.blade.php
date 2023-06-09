@extends('front.layout.master')
@section('sabad')
@auth()
<button type="button" data-toggle="dropdown" data-loading-text="بارگذاری ..." class="heading dropdown-toggle">
    <span class="cart-icon pull-left flip"></span>
    <span id="cart-total">{{ $Number }} آیتم - {{$KolPardakht  }} تومان</span>
</button>
<ul class="dropdown-menu">
    <li>
      <table class="table">
        <tbody>
            @if ($cart)
                @foreach ($cart->products as $product)
                <tr>
                    <td class="text-center">
                    @if (count($product->photos)>0)
                        @foreach ($product->photos as $photo)
                            @if ($photo->pivot->IsAsli==1)
                            <a href="product.html">
                                <img class="img-thumbnail" width="80px" title="کفش راحتی مردانه" alt="کفش راحتی مردانه" src="{{ asset('/storage/products/Asli/'.$photo->path.'') }}">
                            </a>
                            @else
                            @endif
                        @endforeach
                    @else
                        <a href="product.html">
                            <img class="img-thumbnail" width="80px" title="کفش راحتی مردانه" alt="کفش راحتی مردانه" src="{{ asset('/storage/products/Sayer/1657529749formal-men-shirt-17.jpg') }}">
                        </a>
                    @endif

                    </td>
                    <td class="text-left"><a href="product.html">{{ $product->title }}</a></td>
                    <td class="text-right">x {{ $product->pivot->Tedad }}</td>
                    <td class="text-right">
                        @if ($product->discount_price)
                        <p class="price"><span class="price-new">{{ $product->discount_price }} تومان</span> <span class="price-old">{{ $product->price }} تومان</span></p>
                        @else
                        <p class="price"> {{ $product->price }}</p>
                        @endif
                    </td>
                    <td class="text-center"><a href="{{ route('RemoveProductFromCart',[$product->id,auth()->user()->id]) }}">❌</a></td>
                </tr>
                @endforeach
            @endif
        </tbody>
      </table>
    </li>
    <li>
      <div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                  <td class="text-right"><strong>جمع کل</strong></td>
                  <td class="text-right">{{ $KolePoll }} تومان</td>
                </tr>
                <tr>
                  <td class="text-right"><strong>کسر تخفیف</strong></td>
                  <td class="text-right">{{$KolePoll-$KolPardakht  }} تومان</td>
                </tr>
                <tr>
                  <td class="text-right"><strong>قابل پرداخت</strong></td>
                  <td class="text-right">{{$KolPardakht  }} تومان</td>
                </tr>
            </tbody>
        </table>
        <p class="checkout"><a href="{{ route('getcart',auth()->user()->id) }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> مشاهده سبد</a></p>
      </div>
    </li>
  </ul>

@endauth

@endsection
@section('content')

    <!-- Main آقایانu End-->

<div id="container">

  <div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('RemoveProduct'))
    <div class="alert alert-danger"><b>{{ session('RemoveProduct') }}</b></div>
    @endif
    @if (session('AddProduct'))
    <div class="alert alert-success"><b>{{ session('AddProduct') }}</b></div>
    @endif
    @if (session('error'))
    <div class="alert alert-warning"><b>{{ session('error') }}</b></div>
    @endif
    <div class="row">
      <!--Middle Part Start-->
      <div id="content" class="col-xs-12">
        <!-- Slideshow Start-->
        <div class="slideshow single-slider owl-carousel">
            {{-- <div class="item"> <a href="#"><img class="img-responsive" src="front/image/banner/sample-banner-1-400x200.jpg" alt="banner 2" /></a> </div> --}}
            <div class="item"> <a href="#"><img class="img-responsive" src="{{ asset('front/image/slider/banner-2.jpg') }}" alt="banner 2" /></a> </div>
            <div class="item"> <a href="#"><img class="img-responsive" src="{{ asset('front/image/slider/banner-1.jpg') }}" alt="banner 1" /></a> </div>
        </div>
        <!-- Slideshow End-->
        <!-- Banner Start-->
        <div class="marketshop-banner">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="{{ asset('front/image/banner/sample-banner-1-400x200.jpg') }}" alt="بنر نمونه 2" title="بنر نمونه 2" /></a></div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="{{ asset('front/image/banner/sample-banner-1-400x200.jpg') }}" alt="بنر نمونه" title="بنر نمونه" /></a></div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="{{ asset('front/image/banner/sample-banner-1-400x200.jpg') }}" alt="بنر نمونه 3" title="بنر نمونه 3" /></a></div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"><a href="#"><img src="{{ asset('front/image/banner/sample-banner-1-400x200.jpg') }}" alt="بنر نمونه 4" title="بنر نمونه 4" /></a></div>
          </div>
        </div>
        <!-- Banner End-->
        <!-- محصولات Tab Start -->
        <div id="product-tab" class="product-tab">
<ul id="tabs" class="tabs">
  <li><a href="#tab-latest">جدیدترین</a></li>
  <li><a href="#tab-featured">ویژه</a></li>
  <li><a href="#tab-bestseller">پرفروش</a></li>
  <li><a href="#tab-special">پیشنهادی</a></li>
</ul>
<div id="tab-latest" class="tab_content">
    <div class="owl-carousel product_carousel_tab">
        @foreach ($Lastproducts as $product)
        <div class="product-thumb clearfix">
            @if (count($product->photos)>0)
                @foreach ($product->photos as $photo)
                    @if ($photo->pivot->IsAsli==1)
                        <div class="image"><a href="{{ route('ShowProduct',$product->id) }}"><img src="{{ asset('/storage/products/Asli/'.$photo->path.'') }}" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive"  /></a></div>
                    @else
                    @endif
                @endforeach
            @else
                <div class="image"><a href="{{ route('ShowProduct',$product->id) }}"><img src="{{ asset('/storage/products/Sayer/1657529749formal-men-shirt-17.jpg') }}" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive"  /></a></div>
            @endif

            <div class="caption">
              <h4><a href="{{ route('ShowProduct',$product->id) }}">{{ $product->title }}</a></h4>
              @if ($product->discount_price)
                <p class="price"><span class="price-new">{{ $product->discount_price }} تومان</span> <span class="price-old">{{ $product->price }} تومان</span><span class="saving">{{ abs(round(($product->discount_price-$product->price)/$product->price*100)) }}%</span></p>
              @else
                <p class="price"> {{ $product->price }}</p>
              @endif
            </div>
            <div class="button-group">
              @auth()
                <a href="{{ route('AddProductToCart',[$product->id,auth()->user()->id]) }}"><span>افزودن به سبد</span></a>
              @else
                <span>افزودن به سبد</span>
              @endauth
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی ها" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="مقایسه این محصول" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
        @endforeach
          {{-- <div class="product-thumb clearfix">
            <div class="image"><a href="product.html"><img src="front/image/product/apple_cinema_30-220x330.jpg" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">تی شرت کتان مردانه</a></h4>
              <p class="price"><span class="price-new">110000 تومان</span> <span class="price-old">122000 تومان</span><span class="saving">-10%</span></p>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick="cart.add('42');"><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی ها" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="مقایسه این محصول" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb clearfix">
            <div class="image"><a href="product.html"><img src="front/image/product/samsung_tab_1-220x330.jpg" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">تبلت ایسر</a></h4>
              <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick="cart.add('49');"><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی ها" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="مقایسه این محصول" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb clearfix">
            <div class="image"><a href="product.html"><img src="front/image/product/sony_vaio_1-220x330.jpg" alt="کفش راحتی مردانه" title="کفش راحتی مردانه" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">کفش راحتی مردانه</a></h4>
              <p class="price"> <span class="price-new">32000 تومان</span> <span class="price-old">12 میلیون تومان</span> <span class="saving">-25%</span> </p>
              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick="cart.add('46');"><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی ها" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="مقایسه این محصول" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb clearfix">
            <div class="image"><a href="product.html"><img src="front/image/product/macbook_1-220x330.jpg" alt="آیدیا پد یوگا" title="آیدیا پد یوگا" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">آیدیا پد یوگا</a></h4>
              <p class="price"> 211000 تومان </p>
              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick="cart.add('43');"><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی ها" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="مقایسه این محصول" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb clearfix">
            <div class="image"><a href="product.html"><img src="front/image/product/iphone_1-220x330.jpg" alt="آیفون 7" title="آیفون 7" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">آیفون 7</a></h4>
              <p class="price"> 2200000 تومان </p>
              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی ها" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="مقایسه این محصول" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb clearfix">
            <div class="image"><a href="product.html"><img src="front/image/product/canon_eos_5d_1-220x330.jpg" alt="تیشرت آستین بلند مردانه" title="تیشرت آستین بلند مردانه" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">تیشرت آستین بلند مردانه</a></h4>
              <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-20%</span> </p>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی ها" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="مقایسه این محصول" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div> --}}
        </div>
</div>

<div id="tab-featured" class="tab_content">
  <div class="owl-carousel product_carousel_tab">
          <div class="product-thumb">
            <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_2-220x330.jpg') }}" alt="عطر نینا ریچی" title="عطر نینا ریچی" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">عطر نینا ریچی</a></h4>
              <p class="price"> 110000 تومان </p>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb">
            <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_3-220x330.jpg') }}" alt="رژ لب گارنیر" title="رژ لب گارنیر" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">رژ لب گارنیر</a></h4>
              <p class="price"> 123000 تومان </p>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb">
            <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_4-220x330.jpg') }}" alt="عطر گوچی" title="عطر گوچی" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">عطر گوچی</a></h4>
              <p class="price"> 85000 تومان </p>
              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb">
            <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/iphone_6-220x330.jpg') }}" alt="کرم مو آقایان" title="کرم مو آقایان" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">کرم مو آقایان</a></h4>
              <p class="price"> 42300 تومان </p>
              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb">
            <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/nikon_d300_5-220x330.jpg') }}" alt="محصولات مراقبت از مو" title="محصولات مراقبت از مو" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">محصولات مراقبت از مو</a></h4>
              <p class="price"> <span class="price-new">66000 تومان</span> <span class="price-old">90000 تومان</span> <span class="saving">-27%</span> </p>
              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb">
            <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/nikon_d300_4-220x330.jpg') }}" alt="کرم لخت کننده مو" title="کرم لخت کننده مو" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">کرم لخت کننده مو</a></h4>
              <p class="price"> 88000 تومان </p>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
          <div class="product-thumb">
            <div class="image"><a href=""><img src="{{ asset('front/image/product/macbook_5-220x330.jpg') }}" alt="ژل حمام بانوان" title="ژل حمام بانوان" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">ژل حمام بانوان</a></h4>
              <p class="price"> <span class="price-new">19500 تومان</span> <span class="price-old">21900 تومان</span> <span class="saving">-4%</span> </p>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick="cart.add('61');"><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick="wishlist.add('61');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick="compare.add('61');"><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
        </div>
</div>
<div id="tab-bestseller" class="tab_content">
  <div class="owl-carousel product_carousel_tab">
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/FinePix-Long-Zoom-Camera-220x330.jpg') }}" alt="دوربین فاین پیکس" title="دوربین فاین پیکس" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">دوربین فاین پیکس</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/nikon_d300_1-220x330.jpg') }}" alt="دوربین دیجیتال حرفه ای" title="دوربین دیجیتال حرفه ای" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">دوربین دیجیتال حرفه ای</a></h4>
                    <p class="price"> <span class="price-new">92000 تومان</span> <span class="price-old">98000 تومان</span> <span class="saving">-6%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
</div>
<div id="tab-special" class="tab_content">
  <div class="owl-carousel product_carousel_tab">
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_touch_1-220x330.jpg') }}" alt="سامسونگ گلکسی s7" title="سامسونگ گلکسی s7" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">سامسونگ گلکسی s7</a></h4>
                    <p class="price"> <span class="price-new">62000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-50%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
            <div class="image"><a href=""><img src="{{ asset('front/image/product/macbook_5-220x330.jpg') }}" alt="ژل حمام بانوان" title="ژل حمام بانوان" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">ژل حمام بانوان</a></h4>
              <p class="price"> <span class="price-new">19500 تومان</span> <span class="price-old">21900 تومان</span> <span class="saving">-4%</span> </p>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick="cart.add('61');"><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick="wishlist.add('61');"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick="compare.add('61');"><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_air_1-220x330.jpg') }}" alt="لپ تاپ ایلین ور" title="لپ تاپ ایلین ور" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">لپ تاپ ایلین ور</a></h4>
                    <p class="price"> <span class="price-new">10 میلیون تومان</span> <span class="price-old">12 میلیون تومان</span> <span class="saving">-5%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb clearfix">
            <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/apple_cinema_30-220x330.jpg') }}" alt="تی شرت کتان مردانه" title="تی شرت کتان مردانه" class="img-responsive" /></a></div>
            <div class="caption">
              <h4><a href="product.html">تی شرت کتان مردانه</a></h4>
              <p class="price"><span class="price-new">110000 تومان</span> <span class="price-old">122000 تومان</span><span class="saving">-10%</span></p>
            </div>
            <div class="button-group">
              <button class="btn-primary" type="button" onClick="cart.add('42');"><span>افزودن به سبد</span></button>
              <div class="add-to-links">
                <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی ها" onClick=""><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="مقایسه این محصول" onClick=""><i class="fa fa-exchange"></i></button>
              </div>
            </div>
          </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_pro_1-220x330.jpg') }}" alt=" کتاب آموزش باغبانی " title=" کتاب آموزش باغبانی " class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html"> کتاب آموزش باغبانی </a></h4>
                    <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">120000 تومان</span> <span class="saving">-26%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/samsung_tab_1-220x330.jpg') }}" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">تبلت ایسر</a></h4>
                    <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>

</div>
</div>    <!-- محصولات Tab Start -->
        <!-- Banner Start -->
        <div class="marketshop-banner">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="#"><img src="{{ asset('front/image/banner/sample-banner-4-600x250.jpg') }}" alt="2 Block Banner" title="2 Block Banner" /></a></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="#"><img src="{{ asset('front/image/banner/sample-banner-5-600x250.jpg') }}" alt="2 Block Banner 1" title="2 Block Banner 1" /></a></div>
          </div>
        </div>
        <!-- Banner End -->
        <!-- دسته ها محصولات Slider Start-->
        <div class="category-module" id="latest_category">
          <h3 class="subtitle">مد و زیبایی - <a class="viewall" href="category.tpl">نمایش همه</a></h3>
          <div class="category-module-content">
            <ul id="sub-cat" class="tabs">
              <li><a href="#tab-cat1">آقایان</a></li>
              <li><a href="#tab-cat2">بانوان</a></li>
              <li><a href="#tab-cat3">دخترانه</a></li>
              <li><a href="#tab-cat4">پسرانه</a></li>
              <li><a href="#tab-cat5">نوزاد</a></li>
              <li><a href="#tab-cat6">لوازم</a></li>
            </ul>
            <div id="tab-cat1" class="tab_content">
              <div class="owl-carousel latest_category_tabs">
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/samsung_tab_1-220x330.jpg') }}" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">تبلت ایسر</a></h4>
                    <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_pro_1-220x330.jpg') }}" alt=" کتاب آموزش باغبانی " title=" کتاب آموزش باغبانی " class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html"> کتاب آموزش باغبانی </a></h4>
                    <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">120000 تومان</span> <span class="saving">-26%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_air_1-220x330.jpg') }}" alt="لپ تاپ ایلین ور" title="لپ تاپ ایلین ور" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">لپ تاپ ایلین ور</a></h4>
                    <p class="price"> <span class="price-new">10 میلیون تومان</span> <span class="price-old">12 میلیون تومان</span> <span class="saving">-5%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_1-220x330.jpg') }}" alt="آیدیا پد یوگا" title="آیدیا پد یوگا" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">آیدیا پد یوگا</a></h4>
                    <p class="price"> 211000 تومان </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_shuffle_1-220x330.jpg') }}" alt="لپ تاپ hp پاویلیون" title="لپ تاپ hp پاویلیون" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">لپ تاپ hp پاویلیون</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_touch_1-220x330.jpg') }}" alt="سامسونگ گلکسی s7" title="سامسونگ گلکسی s7" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">سامسونگ گلکسی s7</a></h4>
                    <p class="price"> <span class="price-new">62000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-50%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-cat2" class="tab_content">
              <div class="owl-carousel latest_category_tabs">
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_shuffle_1-220x330.jpg') }}" alt="لپ تاپ hp پاویلیون" title="لپ تاپ hp پاویلیون" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">لپ تاپ hp پاویلیون</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-cat3" class="tab_content">
              <div class="owl-carousel latest_category_tabs">
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/FinePix-Long-Zoom-Camera-220x330.jpg') }}" alt="دوربین فاین پیکس" title="دوربین فاین پیکس" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">دوربین فاین پیکس</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/nikon_d300_1-220x330.jpg') }}" alt="دوربین دیجیتال حرفه ای" title="دوربین دیجیتال حرفه ای" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">دوربین دیجیتال حرفه ای</a></h4>
                    <p class="price"> <span class="price-new">92000 تومان</span> <span class="price-old">98000 تومان</span> <span class="saving">-6%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-cat4" class="tab_content">
              <div class="owl-carousel latest_category_tabs">
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/samsung_tab_1-220x330.jpg') }}" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">تبلت ایسر</a></h4>
                    <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/iphone_1-220x330.jpg') }}" alt="آیفون 7" title="آیفون 7" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">آیفون 7</a></h4>
                    <p class="price"> 2200000 تومان </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_touch_1-220x330.jpg') }}" alt="سامسونگ گلکسی s7" title="سامسونگ گلکسی s7" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">سامسونگ گلکسی s7</a></h4>
                    <p class="price"> <span class="price-new">62000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-50%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/palm_treo_pro_1-220x330.jpg') }}" alt="موبایل HTC M7" title="موبایل HTC M7" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">موبایل HTC M7</a></h4>
                    <p class="price"> 377000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-cat5" class="tab_content">
              <div class="owl-carousel latest_category_tabs">
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/samsung_tab_1-220x330.jpg') }}" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">تبلت ایسر</a></h4>
                    <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">240000 تومان</span> <span class="saving">-5%</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_classic_1-220x330.jpg') }}" alt="آیپاد نسل 5" title="آیپاد نسل 5" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">آیپاد نسل 5</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_pro_1-220x330.jpg') }}" alt=" کتاب آموزش باغبانی " title=" کتاب آموزش باغبانی " class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html"> کتاب آموزش باغبانی </a></h4>
                    <p class="price"> <span class="price-new">98000 تومان</span> <span class="price-old">120000 تومان</span> <span class="saving">-26%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_air_1-220x330.jpg') }}" alt="لپ تاپ ایلین ور" title="لپ تاپ ایلین ور" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">لپ تاپ ایلین ور</a></h4>
                    <p class="price"> <span class="price-new">10 میلیون تومان</span> <span class="price-old">12 میلیون تومان</span> <span class="saving">-5%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/macbook_1-220x330.jpg') }}" alt="آیدیا پد یوگا" title="آیدیا پد یوگا" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">آیدیا پد یوگا</a></h4>
                    <p class="price"> 211000 تومان </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_nano_1-220x330.jpg') }}" alt="پخش کننده موزیک" title="پخش کننده موزیک" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">پخش کننده موزیک</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/FinePix-Long-Zoom-Camera-220x330.jpg') }}" alt="دوربین فاین پیکس" title="دوربین فاین پیکس" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">دوربین فاین پیکس</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_shuffle_1-220x330.jpg') }}" alt="لپ تاپ hp پاویلیون" title="لپ تاپ hp پاویلیون" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">لپ تاپ hp پاویلیون</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('34');"><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick="wishlist.add('34');"><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick="compare.add('34');"><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_touch_1-220x330.jpg') }}" alt="سامسونگ گلکسی s7" title="سامسونگ گلکسی s7" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">سامسونگ گلکسی s7</a></h4>
                    <p class="price"> <span class="price-new">62000 تومان</span> <span class="price-old">122000 تومان</span> <span class="saving">-50%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/nikon_d300_1-220x330.jpg') }}" alt="دوربین دیجیتال حرفه ای" title="دوربین دیجیتال حرفه ای" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">دوربین دیجیتال حرفه ای</a></h4>
                    <p class="price"> <span class="price-new">92000 تومان</span> <span class="price-old">98000 تومان</span> <span class="saving">-6%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-cat6" class="tab_content">
              <div class="owl-carousel latest_category_tabs">
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset("front/image/product/ipod_classic_1-220x330.jpg") }}" alt="آیپاد نسل 5" title="آیپاد نسل 5" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">آیپاد نسل 5</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('48');"><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/ipod_nano_1-220x330.jpg') }}" alt="پخش کننده موزیک" title="پخش کننده موزیک" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="product.html">پخش کننده موزیک</a></h4>
                    <p class="price"> 122000 تومان </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- دسته ها محصولات Slider End-->

        <!-- دسته ها محصولات Slider Start -->
        <h3 class="subtitle">دیجیتال - <a class="viewall" href="category.html">نمایش همه</a></h3>
        <div class="owl-carousel latest_category_carousel">


          @foreach ($AlbaseCategoryProducts as $product)
          @foreach ($product->categories as $cat)
            @if ($cat->id==10)
            <div class="product-thumb">
                @if (count($product->photos)>0)
                    @foreach ($product->photos as $photo)
                        @if ($photo->pivot->IsAsli==1)
                            <div class="image"><a href="product.html"><img src="{{ asset('/storage/products/Asli/'.$photo->path.'') }}" alt="کرم لخت کننده مو" title="کرم لخت کننده مو" class="img-responsive" /></a></div>
                        @endif
                    @endforeach
                @else
                <div class="image"><a href="product.html"><img src="{{ asset('front/image/product/nikon_d300_4-220x330.jpg') }}" alt="کرم لخت کننده مو" title="کرم لخت کننده مو" class="img-responsive" /></a></div>
                @endif
                <div class="caption">
                  <h4><a href="product.html">{{ $product->title }}</a></h4>
                  @if ($product->discount_price)
                    <p class="price"> <span class="price-new">{{ $product->discount_price }} تومان</span> <span class="price-old">{{ $product->price }} تومان</span> <span class="saving">{{ abs(round(($product->discount_price-$product->price)/$product->price*100)) }}%</span> </p>
                  @else
                    <p class="price"> {{ $product->price }} تومان </p>
                  @endif

                </div>
                <div class="button-group">
                  <button class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                  <div class="add-to-links">
                    <button type="button" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                    <button type="button" data-toggle="tooltip" title="افزودن به مقایسه" onClick=""><i class="fa fa-exchange"></i></button>
                  </div>
                </div>
              </div>
            @endif
          @endforeach

          @endforeach


        </div>
        <!-- دسته ها محصولات Slider End -->

        <!-- برند Logo Carousel Start-->
        <h3 class="subtitle">برند ها - <a class="viewall" href="category.html">نمایش همه</a></h3>

        <div id="carousel" class="owl-carousel nxt">
            @foreach ($brands as $brand)
                <div class="item text-center"> <a href="#"><img src="{{ asset('/storage/photos/'.$brand->photo->path.'') }}" width="100px" height="100px" alt="{{ $brand->title }}" class="img-responsive" /></a> </div>
            @endforeach
        </div>
        <!-- برند Logo Carousel End -->
      </div>
      <!--Middle Part End-->
    </div>
  </div>
</div>
<!-- Feature Box Start-->
  <div class="container">
    <div class="custom-feature-box row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="feature-box fbox_1">
          <div class="title">ارسال رایگان</div>
          <p>برای خرید های بیش از 100 هزار تومان</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="feature-box fbox_2">
          <div class="title">پس فرستادن رایگان</div>
          <p>بازگشت کالا تا 24 ساعت پس از خرید</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="feature-box fbox_3">
          <div class="title">کارت هدیه</div>
          <p>بهترین هدیه برای عزیزان شما</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="feature-box fbox_4">
          <div class="title">امتیازات خرید</div>
          <p>از هر خرید امتیاز کسب کرده و از آن بهره بگیرید</p>
        </div>
      </div>
    </div>
  </div></div>
  <!-- Feature Box End-->

@endsection
