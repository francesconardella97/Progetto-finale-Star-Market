<x-main>
    <div class="container-fluid p-5 bg-gradient bg-warning shadow mb-5">
        <div class="row">
           
            <div class="col-12 text-dark m-3">
                @if(session()->has('message'))
                <div class="alert alert-success">{{session('message')}}
                </div>
             @endif
                <h1 class="text-center">
                    {{ $announcement_to_check ? __('ui.revision') : __('ui.notrevision') }}
                </h1>
            </div>
        </div>
        
    </div>
     @if ($announcement_to_check)
    <div class="container my-5 overlay card">
        <div class="row">
            
            {{-- carousel e card annuncio da revisionare--}}
           
            <h2 class="neonText2 m-3 display-5">{{$announcement_to_check->title}}</h2>
            <div class="col-md-6 col-lg-6 col-12">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    @if ($announcement_to_check->images)
                    <div class="carousel-inner">
                        @foreach ($announcement_to_check->images as $image )
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
                <div class="col-md-6 col-lg-3 col-12">

                    <div class="card-body">
                        {{-- <h5 class="card-title mt-3">{{$announcement->title}}</h5> --}}
                        <p class="card-text fs-5  mt-4"><strong>{{$announcement_to_check->body}}</strong></p>
                        <p class="card-text">{{__('ui.price')}}: € {{$announcement_to_check->price}}</p>
                        
                        <a href="{{route('categoryShow',['category'=>$announcement_to_check->category])}}" class=" my-3 btn btn-warning">{{__('ui.category')}}: {{$announcement_to_check->category->name}}</a>
                        <p class="card-footer">{{__('ui.publishedOn')}}: {{$announcement_to_check->created_at->format('d/m/y')}}  <br>{{__('ui.author')}}: {{$announcement_to_check->user->name}}</p>
                        <span><form  class="d-inline" action="{{route('revisor.accept_announcement', ['announcement'=>$announcement_to_check],  ['stato'=>'promosso'])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success shadow d-inline" type="submit">{{__('ui.accept')}}</button>
                            </form></span>
                            <p class="d-inline"><form class="d-inline" action="{{route('revisor.reject_announcement', ['announcement'=>$announcement_to_check], ['stato'=>'rifiutato'])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-danger shadow d-inline" type="submit">{{__('ui.reject')}}</button>
                            </form></p>
                    </div>
                     
                </div>
            </div>
            
            <div class="row py-4 m-2"> @foreach ($announcement_to_check->images as $image )
                <div class="col-12 col-lg-2 border-end card m-2">
                    <img src="{{Storage::url($image->path)}}" alt="" class="img-fluid p-3 rounded" alt="">

                    <h5 class="tc-accent mt-3">Tags</h5>
                    
                    <div class="p-2">
                        @if ($image->labels)
                        @foreach ($image->labels as $label )
                            <p class="d-inline">#{{$label}}</p>
                        @endforeach
                            
                        @endif</div> 
                </div>
                <div class="col-lg-3">
                    <div class="card-body text-end">
                        <h5 class="tc-accent">{{__('ui.imageReview')}}</h5>
                        <p>{{__('ui.adult')}}: <span class="{{$image->adult}}"></span></p>
                        <p>{{__('ui.spoof')}}: <span class="{{$image->spoof}}"></span></p>
                        <p>{{__('ui.medical')}}: <span class="{{$image->medical}}"></span></p>
                        <p>{{__('ui.violence')}}: <span class="{{$image->violence}}"></span></p>
                        <p>{{__('ui.racy')}}: <span class="{{$image->racy}}"></span></p>


                    </div>
                </div>
                @endforeach
            </div> 
            @endif


            {{-- annuncio già revisionato --}}
            @if ($announcement)
            <div class="col-12 col-md-4 col-lg-3 m-5 card h-100 pb-2 shadow-mrk border border-danger border-5">
                <div>
                    <p class="m-3 fw-bold">
                        {{__('ui.youHaveJust')}}<span class="h4"> @if ($stato=='accettato')
                            {{__('ui.accepted')}} 
                            @else 
                            {{__('ui.rejected')}}
                            
                        @endif</span> {{__('ui.thisAnnouncement')}}: <strong class="text-dark"><p class="h4 m-3">{{$announcement->title}}</p></strong>
                    </p>
                    <h6 class="m-3"> {{__('ui.wantToCancel')}}</h6>
                </div>
                    <form action="{{route('revisor.cancel_announcement', ['announcement'=>$announcement])}}" method="POST">
                    @csrf
                    @method('PATCH')
                        <span class="fw-bold m-3">{{__('ui.useTheForce')}}</span>
                        <button class="btn btn-dark shadow py-0  neonText2 recall" type="submit">{{__("ui.recall")}}</button>
                    </form>
            </div>       
            @endif
        </div>
    </div>
    @if ($announcement_to_check)
    @else
    <div class="spazio mt-5">
    </div>
    
    @endif    
<div class="container ">
    <div class="row ">
        <div class="col-12 overlay pb-3 card ">
                <div class="ms-3">
                    <h3 class=" text-center pt-3 ">{{__('ui.rejectedAnnouncements')}}</h3>
                    <table class="w-100">
                        <thead class="">
                            <tr>
                                <th>{{__('ui.title')}}</th>
                                <th>{{__('ui.author')}}</th>
                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($refusedAnnouncements as $announcement )
                            <tr>
                                <td>{{$announcement->title}}</td>
                                <td>{{$announcement->user->name}}</td>
                                <td class="text-center"><form action="{{route('revisor.cancel_announcement', ['announcement'=>$announcement])}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <span class="fw-bold">{{__('ui.useTheForce')}}</span>
                                    <button class="btn btn-dark shadow py-0 neonText2 recall" type="submit">{{__('ui.recall')}}</button>
                                </form></td>
                            </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
        
<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <div id='app'></div>
        </div>
        
    </div>
</div>

<!-- partial -->
  <script src='https://fb.me/react-15.1.0.min.js'></script>
<script src='https://fb.me/react-dom-15.1.0.min.js'></script>  

</x-main>
