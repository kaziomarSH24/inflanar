@extends('layout')
@section('title')
    <title>{{__('admin.Favorite List')}}</title>
@endsection
@section('frontend-content')

<!-- Breadcrumbs -->
<section class="inflanar-breadcrumb" style="background-image: url({{ asset($breadcrumb) }});">
    <div class="container">
        <div class="row">
            <!-- Breadcrumb-Content -->
            <div class="col-12">
                <div class="inflanar-breadcrumb__inner">
                    <div class="inflanar-breadcrumb__content">
                        <h2 class="inflanar-breadcrumb__title m-0">{{__('admin.Favorite List')}}</h2>
                        <ul class="inflanar-breadcrumb__menu list-none">
                            <li><a href="{{ route('home') }}">{{__('admin.Home')}}</a></li>
                            <li class="active"><a href="javascript:;">{{__('admin.Favorite List')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End breadcrumbs -->

<!-- Features -->
<section class="inflaner-inner-page pd-top-90 pd-btm-120">
    <div class="container">
        <div class="inflanar-personals">
            <div class="row">
                @include('profile.sidebar')

                <div class="col-lg-9 col-md-8 col-12  inflanar-personals__content mg-top-30">
                    <div class="inflanar-table inflanar-table__favorite p-0">
                        <table id="inflanar-table__order" class="inflanar-table__main inflanar-table__main-service">
                            <!-- sherah Table Head -->
                            <thead class="inflanar-table__head">
                                <tr>
                                    <th class="inflanar-table__column-1 inflanar-table__h1">{{__('admin.Service Info')}}</th>
                                    <th class="inflanar-table__column-2 inflanar-table__h2">{{__('admin.Influencer')}}</th>
                                    <th class="inflanar-table__column-4 inflanar-table__h4">{{__('admin.Amount')}}</th>
                                    <th class="inflanar-table__column-7 inflanar-table__h6">{{__('admin.Action')}}</th>
                                </tr>
                            </thead>
                            <tbody class="inflanar-table__body">
                                @forelse ($services as $index => $service)
                                <tr>
                                    <td class="inflanar-table__column-1 inflanar-table__data-1">
                                        <div class="inflanar-table__service">
                                            <div class="inflanar-table__sthumb">
                                                <img src="{{ asset($service->thumbnail_image) }}">
                                                <div class="inflanar-table__scontent">
                                                    <h4 class="inflanar-table__stitle">
                                                        <a href="{{ route('service', $service->slug) }}">{{ $service->title }}</a>
                                                    </h4>

                                                    <div class="inflanar-service__author--rating">
                                                        @php
                                                            if ($service->total_review > 0) {
                                                                $average = $service->average_rating;

                                                                $int_average = intval($average);

                                                                $next_value = $int_average + 1;
                                                                $review_point = $int_average;
                                                                $half_review=false;
                                                                if($int_average < $average && $average < $next_value){
                                                                    $review_point= $int_average + 0.5;
                                                                    $half_review=true;
                                                                }
                                                            }
                                                        @endphp
                                                        <div class="inflanar-service__author--star">
                                                            @if ($service->total_review > 0)
                                                                @for ($i = 1; $i <=5; $i++)
                                                                    @if ($i <= $review_point)
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    @elseif ($i> $review_point )
                                                                        @if ($half_review==true)
                                                                        <span><i class="fa-solid fa-star-half-stroke"></i></span>
                                                                            @php
                                                                                $half_review=false
                                                                            @endphp
                                                                        @else
                                                                        <span><i class="fa-regular fa-star"></i></span>
                                                                        @endif
                                                                    @endif
                                                                @endfor
                                                            @else
                                                                <span><i class="fa-regular fa-star"></i></span>
                                                                <span><i class="fa-regular fa-star"></i></span>
                                                                <span><i class="fa-regular fa-star"></i></span>
                                                                <span><i class="fa-regular fa-star"></i></span>
                                                                <span><i class="fa-regular fa-star"></i></span>
                                                            @endif

                                                        </div>
                                                        <div class="inflanar-service__author--label">({{ $service->total_review }})</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="inflanar-table__column-2 inflanar-table__data-2">
                                        <div class="inflanar-table__content">
                                            <p class="inflanar-table__desc">
                                                @if ($service->influencer)
                                                {{ $service->influencer->name }}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="inflanar-table__column-3 inflanar-table__data-4">
                                        <div class="inflanar-table__content">
                                            <p class="inflanar-table__desc">
                                                {{ currency($service->price) }}
                                            </p>
                                        </div>
                                    </td>

                                    <td class="inflanar-table__column-5 inflanar-table__data-5">
                                        <div class="inflanar-table__status__group">
                                            <a href="{{ route('service', $service->slug) }}" class="inflanar-table__action inflanar-table__action--blue"><img src="{{ asset('frontend/img/in-table-eye-icon.svg') }}"></a>
                                            <a href="javascript:;" onclick="deleteDocument({{ $service->id }})" class="inflanar-table__action inflanar-table__action--remove"><img src="{{ asset('frontend/img/in-table-delete-icon.svg') }}"></a>
                                        </div>
                                    </td>
                                </tr>

                                <form class="d-none" action="{{ route('user.remove-wishlist', $service->id) }}" method="POST" id="remove_wishlist-{{ $service->id }}">
                                    @csrf
                                    @method('DELETE')

                                </form>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<!-- End Features -->



<script>

    "use strict";

        function deleteDocument(id){
            Swal.fire({
                title: "{{__('admin.Are you realy want to delete this item ?')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__('admin.Yes, Delete It')}}",
                cancelButtonText: "{{__('admin.Cancel')}}",
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#remove_wishlist-"+id).submit();
                }

            })
        }
    </script>

@endsection
