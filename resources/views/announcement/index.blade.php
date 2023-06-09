<x-main>
    <div class="container my-5 overlay card">
        <div class="row">
            <div class="col-12">
                <h2 class="h2 m-5 fw-bold neonText2">{{__('ui.allAnnouncements')}}</h2>
                <div class="row">
                    @forelse ($announcements as $announcement)
                    <div class="col-12 col-md-6 col-lg-4 my-4">
                        <div class="card mx-auto shadow-mrk"  data-aos="zoom-in-down" data-aos-duration="800" style="width: 18rem;">
                            <img src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(400,300) : 'https://picsum.photos/400/300'}}" class="card-img-top img-fluid" alt="...">
                            <div class="card-body rounded bg-body-tertiary ">
                              <h5 class="card-title title-dimension overflow-hidden">{{$announcement->title}}</h5>
                              {{-- <p class="card-text">{{$anouncement->body}}</p> --}}
                              <p class="card-text">{{__('ui.price')}}: €{{$announcement->price}}</p>
                              <a href="{{route('announcement.show',compact('announcement'))}}" class="btn w-100 btn-warning">{{__('ui.details')}}</a> 
                              <a href="{{route('categoryShow',['category'=>$announcement->category])}}" class="btn w-100 my-2 btn-warning">{{__('ui.category')}}: 
                                @switch(session('locale'))
                                @case('en')
                                {{$announcement->category->English}}
                                @break
                                @case('es')
                                {{$announcement->category->Spanish}}
                                @break
                                
                                @default
                                {{$announcement->category->name}}
                                @endswitch
                            </a>
                              <p class="card-footer bg-white">{{__('ui.publishedOn')}}: {{$announcement->created_at->format('d/m/y')}} <br>{{__('ui.author')}}: {{$announcement->user->name}}</p>
                            </div>
                          </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-warning py-3 shadow">
                            <p class="lead">{{__('ui.announcementsSearch')}}</p>
                        </div>
                        <div class="spazio"></div>
                    </div>

                    <div class="spazio"></div>
                    <div class="soldier"></div>
                    @endforelse
                    {{$announcements->appends(Request::except('page'))->links()}}
                </div>
            </div>
        </div>
    </div>
</x-main>