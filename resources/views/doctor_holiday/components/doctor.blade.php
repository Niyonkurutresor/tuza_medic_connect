<div class="d-flex align-items-center">
    <a href="{{route('doctors.show', $row->doctor->id)}}">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->doctor->user->profile_image}}" alt="" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <div class="d-inline-block align-top">
            <div class="d-inline-block align-self-center d-flex">
                <a href="{{route('doctors.show', $row->doctor->id)}}" class="mb-1 text-decoration-none fs-6">
                    {{$row->doctor->user->full_name}}
                </a>
                <div class="star-ratings d-flex align-self-center ms-2">
                    @if($row->doctor->reviews->avg('rating') != 0)
                        @php
                            $rating = $row->doctor->reviews->avg('rating');
                        @endphp
                        @foreach(range(1, 5) as $i)
                            <div class="avg-review-star-div d-flex align-self-center mb-1">
                                @if($rating > 0)
                                    @if($rating > 0.5)
                                        <i class="fas fa-star review-star"></i>
                                    @else
                                        <i class="fas fa-star-half-alt review-star"></i>
                                    @endif
                                @else
                                    <i class="far fa-star review-star"></i>
                                @endif
                            </div>
                            @php $rating--; @endphp
                        @endforeach
                    @else
                        @foreach(range(1, 5) as $i)
                            <div class="avg-review-star-div d-flex align-self-center mb-1">
                                <i class="far fa-star review-star"></i>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <span class="fs-6">{{$row->doctor->user->email}}</span>
    </div>
</div>
