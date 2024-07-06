<!-- <h1><?php echo $heading; ?></h1>
    <?php foreach($listings as $listing): ?>
    <h2><?php echo $listing['title']; ?></h2>
    <p><?php echo $listing ['id']; ?></p>
    <?php endforeach; ?>                      php is somewhat fuddu 
    
    Well lets use blade-->
    <!--<h1>{{$heading}}</h1>    
                    
    @foreach($listings as $listing)
    <h2>{{$listing['title']}}</h2>
    <p>{{$listing ['id']}}</p>   eloquent basically gives us a collection, so we can access fields like $listing->title as well.
    <p>{{$listing['description']}}</p>
    @endforeach
     @if(count($listings)==0)         {{--  Conditional (cana also have else in it--}}
    <p>No listings found</p>
    @endif
    {{-- We have directives here that can be used for loops,conditions(start with @) --}}
    {{-- We have a php directive also, in which you can write php code------->  @php   @endphp 
        We also have unless directive @unless,@endunless --}}
                    Well lets start our real project -->