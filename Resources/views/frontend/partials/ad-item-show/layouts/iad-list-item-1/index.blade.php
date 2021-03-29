<div class="container">
  <div class="row">
    <div class="col-lg-6 pb-4">
      <div class="modal-images">
        
        <div id="carouselGallery" class="carousel slide mb-2" data-ride="carousel">
          <a class="carousel-control-prev" href="#carouselGallery" role="button" data-slide="prev">
            <span class="fa fa-caret-right" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselGallery" role="button" data-slide="next">
            <span class="fa fa-caret-left" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <a
                href="https://sexy-latinas.imaginacolombia.com/assets/Iad/ad/3YfGSuM7p8/gallery/0ZiUpnEdBa3yjZ7Xbd0gBl3zLA6m5ugK.jpg"
                data-fancybox="gallery" data-caption="Nombre persona">
                <picture class="slider-cover">
                  <x-media::single-image :alt="$item->title ?? $item->name"
                                         :title="$item->title ?? $item->name"
                                         :url="$item->url ?? null" :isMedia="true"
                                         imgClasses=""
                                         :mediaFiles="$item->mediaFiles()"/>
                </picture>
              </a>
            </div>
          
          </div>
        
        </div>
        <!--carusel de abajo-->
        <div class="owl-carousel owl-image-mini owl-theme">
          <div class="item">
            <picture class="slider-cover">
              
              <x-media::single-image :alt="$item->title ?? $item->name"
                                     :title="$item->title ?? $item->name"
                                     :url="$item->url ?? null" :isMedia="true"
                                     imgClasses=""
                                     :mediaFiles="$item->mediaFiles()"/>
            </picture>
          </div>
        </div>
      
      </div>
    
    </div>
    <div class="col-lg-6 pb-4">
      
      <h2 class="modal-title mb-3">
        {{$item->title}}
      </h2>
      <span class="badge info-badge">
          {{--Medellín--}}
        @if(isset($item->city->name))
          {{$item->city->name}}
        @endif
        </span>
      <span class="badge info-badge">

          {{--21 años--}}
        @if(isset(collect($item->fields)->where('name','age')->first()->value))
          {{collect($item->fields)->where('name','age')->first()->value}} años
        @endif
        </span>
      <span class="badge info-badge">${{formatMoney($item->min_price)}}</span>
      <span class="badge info-badge">{{$item->country->name}}</span>
      @if($item->status == 3)
        <span class="badge info-badge certified" title="{{trans("iad::status.checked")}}"></span>
      @endif
      @php($videos = $item->mediaFiles()->videos)
      @if(count($videos)>0)
        <span class="badge info-badge videos">{{count($videos)}}</span>
      @endif
      @php($gallery = $item->mediaFiles()->gallery)
      @if(count($gallery)>0)
        <span class="badge info-badge photos">
          <i class="fa fa-camera" aria-hidden="true"></i>
          {{count($gallery)}}</span>
      @endif
      
      <p class="modal-date my-3">
        06/11/2020 | 5:00PM
      </p>
      
      <div class="modal-description">
        {!! nl2br ($item->description) !!}
        {{--                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et ullamcorper ante, et mattis ipsum.--}}
        {{--                    Quisque a nisi in risus cursus ullamcorper. Vestibulum et laoreet orci. Duis pulvinar sapien quam,--}}
        {{--                    ut feugiat sem bibendum pellentesque. Interdum et malesuada fames ac ante ipsum primis.</p>--}}
        {{--                  <p>Curabitur congue tristique purus, non imperdiet dui tempus sit amet. Donec tincidunt congue sapien--}}
        {{--                    id placerat. Pellentesque id consequat arcu. Vestibulum sagittis velit non hendrerit pharetra.</p>--}}
      </div>
      
      
      <div class="group-btn">
        @if(isset(collect($item->fields)->where('name','whatsapp')->first()->value))
          <a class="btn btn-whatsapp" href="" target="_blank">
            <i class="fa fa-whatsapp"></i> WhatsApp
          </a>
        @endif
        
        @if(isset(collect($item->fields)->where('name','twitter')->first()->value))
          <a class="btn btn-twitter"
             href="" target="_blank">
            <i class="fa fa-twitter"></i>twitter
            {{collect($item->fields)->where('name','twitter')->first()->value}}
          </a>
        @endif
        
        @if(isset(collect($item->fields)->where('name','phone')->first()->value))
          <a class="btn btn-phone" href="tel:collect($item->fields)->where('name','phone')->first()->value"
             target="_blank">
            <i class="fa fa-mobile"></i> {{collect($item->fields)->where('name','phone')->first()->value}}
          </a>
        @endif
        
        <a class="btn btn-like"
           onClick="window.livewire.emit('addToWishList',{{json_encode(["entityName" => "Modules\\Iad\\Entities\\Ad", "entityId" => $item->id])}})">
          <i class="fa fa-heart"></i>
        </a>
      </div>
    
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <hr class="mb-4">
    </div>
  </div>
  
  <div class="row">
    <!--Rates-->
    @if(isset($item->options->prices))
      <div class="col-lg-6 pb-4">
        <h3 class="modal-title mb-3">
          Tarifas
        </h3>
        @foreach($item->options->prices as $rate)
          <div class="row align-items-center modal-item">
            <div class="col-5 col-sm-3">{{$rate->description}}</div>
            <div class="col-2 col-sm-5">
              <hr class="solid">
            </div>
            <div class="col-5 col-sm-4 text-primary">${{formatMoney($rate->value)}}</div>
          </div>
        @endforeach
      </div>
    @endif
  <!--Schedule-->
    @if(isset($item->options->schedule))
      <div class="col-lg-6 pb-4">
        <h3 class="modal-title mb-3">
          Horarios
        </h3>
        @foreach($item->options->schedule as $schedule)
          <div class="row align-items-center modal-item">
            <div class="col-5 col-sm-4">
              
              {{trans("iad::schedules.days.".$schedule->name)}}
            
            </div>
            <div class="col-2 col-sm-4">
              <hr class="solid">
            </div>
            <div class="col-5 col-sm-4 text-primary">
              @if($schedule->schedules == 1)
                {{trans("iad::schedules.schedules.24Hours")}}
              @else
                @foreach($schedule->schedules as $shift)
                  {{date("g:ia",strtotime($shift->from))}} -
                  {{date("g:ia",strtotime($shift->to))}}
                @endforeach
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @endif
    
    <div class="col-lg-12 pb-4">
      <hr>
    </div>
  </div>
  
  
  <div class="row">
    
    
    @foreach($categories->toTree() as $categoryParent)
      @php($categoriesAd = array_intersect($item->categories->pluck("id")->toArray(),$categoryParent->children->pluck("id")->toArray()))
      @if(!empty($categoriesAd))
        
        <div class="col-12 pb-4">
          <h3 class="modal-title mb-3">
            {{$categoryParent->title}}
          </h3>
          @foreach($categoriesAd as $categoryId)
            @php($categoryAd = $item->categories->where("id",$categoryId)->first())
            <span class="badge info-badge">{{$categoryAd->title}}</span>
          @endforeach
        </div>
      @endif
    @endforeach
    
    <div class="col-lg-12 pb-4">
      <hr>
    </div>
  </div>
  
  @if(isset($item->options->map->title) && !empty($item->options->map->lat) && !empty($item->options->map->lng))
    <div class="row">
      
      
      <div class="col-lg-8 pb-4">
        <h3 class="modal-title mb-3">
          Ubicación
        </h3>
        <div id="girl-map{{$item->id}}">
        </div>
      </div>
    
    </div>
    @push("css-stack")
      <style type="text/css">
        #girl-map{{$item->id}}   {
          height: 400px;
          width: 100%;
        }
      </style>
    @endpush
  @section("scripts")
    @parent
    <script>
      // Initialize and add the map
      $(document).ready(function () {
        // The map, centered at Uluru
        var map{{$item->id}} = new google.maps.Map(document.getElementById("girl-map{{$item->id}}"), {
          zoom: 16,
          center: {lat: {{$item->options->map->lat}}, lng: {{$item->options->map->lng}} },
        });
        // The marker, positioned at Uluru
        var marker{{$item->id}} = new google.maps.Marker({
          position: {lat: {{$item->options->map->lat}}, lng: {{$item->options->map->lng}} },
          map: map{{$item->id}},
        });
      });
    
    </script>
  @stop
  @endif
  
  <div class="row justify-content-center">
    <div class="col-auto">
      <a class="btn btn-flag" data-toggle="collapse" href="#collapseGirl{{$item->id}}" role="button"
         aria-expanded="false" aria-controls="collapseGirl{{$item->id}}">
        <img class="img-fluid" src="{{Theme::url('girls-publication/ico-denunciar.png')}}" alt="Flag this ad">
        Denunciar éste anuncio
      </a>
    </div>
    <div class="col-12">
      <div class="collapse mt-4" id="collapseGirl{{$item->id}}">
        <div class="card card-body pt-4 bg-light">
          
          {!! Forms::render('denuncia','iforms::frontend.form.bt-nolabel.form') !!}
          
          <p class="text-justify mt-4 mb-0"><strong>Nota:</strong> Si el motivo de la denuncia es que eres la
            persona que aparece en las fotos y quieres eliminar el anuncio, y no tienes acceso ni al email que
            se usó para publicarlo ni al teléfono que aparece en el anuncio, debes indicarnos un teléfono y
            email para que podamos contactar contigo y confirmar que realmente eres tú.</p>
        </div>
      </div>
    </div>
  </div>
</div>