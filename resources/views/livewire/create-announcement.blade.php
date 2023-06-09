<div class="container overlay mt-5 card">
    <div class="row mx-5">
        <div class="col-12 col-lg-6">
            <h2 class="mt-5 neonText2">{{__('ui.insertYourAnnouncement')}}</h2>
            <x-success/>
             {{--  --}}
             @if(session()->has('success'))
      @else
        <div class="spazio_2"></div>      
        @endif
      @if(session()->has('success'))
      <audio autoplay>
      
        <source src="{{asset('media/audio/StarWars-battuto.mp3')}}" type="audio/mpeg">
    
      </audio>
      
        @endif
           <form wire:submit.prevent="submit">
            <div>
                <label for="title">{{__('ui.title')}}</label>
                <input type="text" class="form-control @error('title')is-invalid @enderror" wire:model.lazy="title">
                @error('title') <span class="small text-danger">{{$message}}</span>@enderror
            </div>
            <div>
                <label for="body">{{__('ui.description')}}</label>
                <input type="text" class="form-control @error('body')is-invalid @enderror" wire:model.lazy="body">
                @error('body') <span class="small text-danger">{{$message}}</span>@enderror
            </div>
            <div>
                <label for="price">{{__('ui.price')}}</label>
                <input type="text" class="form-control @error('price')is-invalid @enderror" wire:model.lazy="price" >
                @error('price') <span class="small text-danger">{{$message}}</span>@enderror
            </div>
        
            <div>
                <label for="category"></label>
                <select wire:model.defer="category" id="category" name="category" class="form-control">
                    <option value="">
                        {{__('ui.categoryChoose')}}
                    </option>
                    
                    
                    
                    @foreach ($categories as $category)
                    @switch(session('locale'))
                                @case('en')
                                <option value="{{$category->id}}">{{$category->English}}</option>
                                @break
                                @case('es')
                                <option value="{{$category->id}}">{{$category->Spanish}}</option>
                                @break
                                
                                @default
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endswitch
                    @endforeach
                       
                    </select>
                    @error('category') <span class="small text-danger">{{$message}}</span>@enderror
            </div>
        
            <div class="my-3">
                <input wire:model="temporary_images" type="file" name="images" multiple class="form-control shadow @error('temporary_images.*')is-invalid @enderror" placeholder="Img"/> @error('temporary_images') <span class="small text-danger">{{$message}}</span>@enderror
            </div>
            @if (!empty($images))
            {{-- @dd(@$image) --}}
            <div class="row">
                <div class="col-12 col-lg-9">
                    <h3 class="neonText2">Photo preview</h3>
                    <div class="row border border-2 border-warning rounded py-4">
                        @foreach ($images as $key => $image)
                        
                            <div class="col my-3">
                                <div class="img-preview mx-auto rounded mb-2" style="background-image: url({{$image->temporaryUrl()}}); background-position: center; background-size: contain; background-repeat: no-repeat;" ></div>
                                <button class="btn btn-danger d-block text-center-mt-2 mx-auto" wire:click="removeImage({{ $key }})" type="button">{{__('ui.delete')}}</button>
                            </div>
                        @endforeach
                    </div>
                    

                </div>

                {{-- decommentare per scegliere lo smile --}}
                <div class="col-3 form-check">
                        
                    <h3 class="neonText2 recall">{{__('ui.smile')}}</h3>
                    
                    <input  type="radio" name="smile" value='dartvader.png' wire:model="smile" id="smile" >
                    <label for="darvader"> Dart Vader</label>
                    <br>
                    <input  type="radio" name="batman" value='batman.png'  wire:model="smile" id="smile2">
                    <label for="batman">Batman</label>
                    <br>
                    <input  type="radio" name="stormtrooper" value='stormtrooper.png'  wire:model="smile" id="smile3">
                    <label for="stormtrooper">Stormtrooper</label>
                    @error('smile') <span class="btn btn-danger">{{$message}}</span>@enderror

                    
                </div>
                
            </div>
                
            @endif
            <div class="mt-3">
                <button class="btn btn-warning" type="submit">{{__('ui.publish')}}</button>
            </div>
           </form>
        </div>
    </div>
    
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="soldier"></div>
        </div>
    </div>
</div>
        <div class="spazio"></div>      
        
</div>
