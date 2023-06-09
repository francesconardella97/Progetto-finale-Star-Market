<x-main>
    <div class="container overlay card mt-5">
        <div class="row">
            <div class="col-12 mt-3">
                <h2 class="h2 my-5 pt-3 fw-bold text-center neonText2">{{__('ui.announcementCategory')}}  @switch(session('locale'))
                    @case('en')
                    {{$category->English}}
                    @break
                    @case('es')
                    {{$category->Spanish}}
                    @break
                    
                    @default
                    {{$category->name}}
                    @endswitch</h2>
                <div class="row">
                    @forelse  ( $category->announcements as $announcement)
                   @if ($announcement->is_accepted)
                   <div class="col-12 col-md-6 col-lg-4 my-4">
                    <div class="card shadow-mrk mx-auto"  data-aos="zoom-in-down" data-aos-duration="800" style="width: 18rem;">
                        <img src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(400,300) : 'https://picsum.photos/400/300'}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{$announcement->title}}</h5>
                          {{-- <p class="card-text">{{$announcement->body}}</p> --}}
                          <p class="card-text">{{__('ui.price')}}: {{$announcement->price}}€</p>
                          <a href="{{route('announcement.show',compact('announcement'))}}" class="btn btn-warning mb-2 w-100">{{__('ui.details')}}</a>
                          
                          <p class="card-footer bg-white">{{__('ui.publishedOn')}}: {{$announcement->created_at->format('d/m/y')}} <br>
                            {{__('ui.author')}}: {{$announcement->user->name ?? ''}}</p>
                        </div>
                      </div>
                    </div> 
                   @endif
                   @empty
                   
                    <div class="col-12 text-center p-5">
                        <p class="h4">{{__("ui.announcementEmpty")}}</p>
                        <p class= "h4">{{__('ui.publishOne')}}: <a href="{{route ('announcement.create')}}"class="btn-warning btn shadow"> {{__('ui.newAnnouncement')}}</a></p>
                    </div>
                    
                    
                    
                    <div style="height: 150px"></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-main>