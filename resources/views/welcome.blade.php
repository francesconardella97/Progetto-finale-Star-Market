<x-main>

  
    
    @if(session()->has('access.denied'))
                <div class="alert alert-danger">{{session('access.denied')}}
                </div>
        @endif
        <x-success/>
    
        <div id="carouselExampleAutoplaying" class="carousel slide container" data-bs-ride="carousel">
            <div class="carousel-inner py-5 ">
              <div class="carousel-item active">
                <img src="{{asset('media/Joda.jpg')}}" class="d-block w-100 opacity-header card overlay" alt="...">
                <div class="position-absolute top-50 start-50 text-center translate-middle neonText">
                    <h1 class="display-1 ">Star Market</h1>
                    <p class="display-6 fw-bold ">{{__('ui.header')}}</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('media/super_mario.jpg')}}" class="d-block w-100 opacity-header card overlay " alt="...">
                <div class="position-absolute top-50 start-50 text-center translate-middle neonText">
                    <h1 class="display-1 ">Star Market</h1>
                    <p class="display-6 fw-bold ">{{__('ui.header')}}</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('media/image3.jpg')}}" class="d-block w-100 opacity-header card overlay" alt="...">
                <div class="position-absolute top-50 start-50 text-center translate-middle neonText">
                    <h1 class="display-1">Star Market</h1>
                    <p class="display-6 fw-bold">{{__('ui.header')}}</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          
    <div class="container">
        <div class="row">
            <div class="col-12 overlay my-5 card">
                <h2 class="h2 m-5 fw-bold neonText2">{{__('ui.allAnnouncements')}}</h2>
                <div class="row">
                    @foreach ($announcements as $announcement)
                    <div class="col-12 col-md-6 col-lg-4 my-4">
                        <div class="card mx-auto shadow-mrk" data-aos="zoom-in-down" data-aos-duration="800" style="width: 18rem;">
                            <img src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(400,300) : 'https://picsum.photos/400/300'}}" class="card-img-top" alt="...">
                            <div class="card-body " >
                              <h5 class="card-title title-dimension overflow-hidden" >{{$announcement->title}}</h5>
                                {{-- <p class="card-text">{{$announcement->body}}</p> --}}
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-main>