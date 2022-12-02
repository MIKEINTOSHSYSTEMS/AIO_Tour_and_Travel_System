@extends('layouts.app')

@section('content')
    <div class="page-profile-content page-template-content">
        @include('Layout::parts.bc')
        <div class="container">
            <div class="">
                <div class="row">
                    <div class="col-md-3">
                        @include('User::frontend.profile.sidebar')
                    </div>
                    <div class="col-md-9">
                        <?php
                        $reviews = \Modules\Review\Models\Review::query()->where([
                            'vendor_id'=>$user->id,
                            'status'=>'approved'
                        ])
                            ->orderBy('id','desc')
                            ->with('author')
                            ->paginate(10);
                        ?>
                        @if($reviews->total())
                            <div class="bravo-reviews">
                                <h3>{{__('Reviews from guests')}}</h3>
                                <div class="review-pag-text">
                                    {{ __("Showing :from - :to of :total total",["from"=>$reviews->firstItem(),"to"=>$reviews->lastItem(),"total"=>$reviews->total()]) }}
                                </div>
                                <div class="mt-3">
                                    @if($reviews)
                                        @foreach($reviews as $item)
                                            @php $userInfo = $item->author;
                                                 if(!$userInfo){
                                                    continue;
                                                 }
                                            @endphp
                                            <div class="media flex-column flex-md-row align-items-center align-items-md-start mb-4">
                                                <div class="mr-md-5">
                                                    <a class="d-block" href="#">
                                                        @if($avatar_url = $userInfo->getAvatarUrl())
                                                            <img class="img-fluid mb-3 mb-md-0 rounded-circle avatar-img" src="{{$avatar_url}}" alt="{{$userInfo->getDisplayName()}}">
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="media-body text-center text-md-left">
                                                    <div class="mb-4">
                                                        <h6 class="font-weight-bold text-gray-3">
                                                            <a href="#">{{$userInfo->getDisplayName()}}</a>
                                                        </h6>
                                                        <div class="font-weight-normal font-size-14 text-gray-9 mb-2">{{display_datetime($item->created_at)}}</div>
                                                        <div class="d-flex align-items-center flex-column flex-md-row mb-2">
                                                            @if($item->rate_number)
                                                                <button type="button" class="btn btn-xs btn-primary rounded-xs font-size-14 py-1 px-2 mr-2 mb-2 mb-md-0">{{$item->rate_number}} /5 </button>
                                                            @endif
                                                            <span class="font-weight-bold font-italic text-gray-3">{{$item->title}}</span>
                                                        </div>
                                                        <p class="text-lh-1dot6 mb-0 pr-lg-5">{{$item->content}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="review-pag-wrapper">
                                    <div class="review-pag-text mb-1">
                                        {{ __("Showing :from - :to of :total total",["from"=>$reviews->firstItem(),"to"=>$reviews->lastItem(),"total"=>$reviews->total()]) }}
                                    </div>
                                    <div class="bravo-pagination">
                                        {{$reviews->appends(request()->query())->links()}}
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="review-pag-text">{{__("No Review")}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
