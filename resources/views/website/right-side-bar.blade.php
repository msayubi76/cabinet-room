 <div class="list-group"> 
    @foreach ($cities as $key=> $city)
        <a href="{{url('country/'.$key)}}" target="_blank" class="list-group-item text-uppercase" > 
        <div class="flags_div " style="    background-image: url({{url('images/flags/'.$key.'.png')}}); ">  </div>  
        JDM {{$city}}  
        </a> 
    @endforeach 
</div>