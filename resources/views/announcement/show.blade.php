<x-main>
    <div class="spazio"></div>
    <div class="container overlay card p-5 mt-5">
        <div class="row">
            <div class="col-md-6 col-12 ">
                <h2 class="neonText2">{{$announcement->title}}</h2>
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                  @if ($announcement->images)
                  <div class="carousel-inner">
                      @foreach ($announcement->images as $image )
                          <div class="carousel-item @if($loop->first)active  @endif ">
                              <img src="{{Storage::url($image->path)}}" alt="" class="img-fluid p-3 rounded" alt="">
                          </div>
                      @endforeach
                  </div>
                      
                  @else
                  
                  
                  {{-- @endif --}}
                  <div class="carousel-inner">
                      <div class="carousel-item active">
                          <img src="https://picsum.photos/1200/700" class="d-block img-fluid w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                          <img src="https://picsum.photos/1200/701" class="d-block img-fluid w-100" alt="...">
                      </div>
                      <div class="carousel-item">
                          <img src="https://picsum.photos/1200/699" class="d-block img-fluid w-100" alt="...">
                      </div>
                      @endif  
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>

    
            <div class="col-md-6 mt-5 col-12">
                <div class="card-body fw-bold">
                    {{-- <h5 class="card-title mt-3">{{$announcement->title}}</h5> --}}
                    <p class="card-text mt-5">{{$announcement->body}}</p>
                    <p class="card-text">{{__('ui.price')}}: €{{$announcement->price}}</p>
                    
                    <a href="{{route('categoryShow',['category'=>$announcement->category])}}" class=" my-3 btn btn-warning">{{__('ui.category')}}: 
                        @switch(session('locale'))
                        @case('en')
                        {{$announcement->category->English}}
                        @break
                        @case('es')
                        {{$announcement->category->Spanish}}
                        @break
                        
                        @default
                        {{$announcement->category->name}}
                        @endswitch</a>
                    <p class="card-footer">{{__('ui.publishedOn')}}: {{$announcement->created_at->format('d/m/y')}}  <br>{{__('ui.author')}}: {{$announcement->user->name}}</p>
                    @guest
                        
                    @else
                        @if (Auth::user()->is_revisor)
                        <div class="col-12 col-md-6 col-lg-5 mt-5 card h-100 pb-2 shadow-mrk border border-danger border-5">
                            <div>
                                
                                <h6 class="m-3"> {{__('ui.wantToCancel')}}</h6>
                            </div>
                                <form  class="m-3" action="{{route('revisor.cancel_announcement', ['announcement'=>$announcement])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                    <span class="fw-bold">{{__('ui.useTheForce')}}</span>
                                    <button class="btn btn-dark shadow py-0 neonText2 recall" type="submit">{{__("ui.recall")}}</button>
                                </form>
                        </div>      
                        @endif
                        
                        @endguest
                  </div>
                  
                  
            </div>


        </div>
        
        
    </div>
   <div class="spazio_2"></div>
</x-main>