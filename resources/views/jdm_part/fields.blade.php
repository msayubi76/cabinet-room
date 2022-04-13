<?php  
$columns = [
    'product',
    'category',
    'name',
    'currency_type',
    'price',
    'feature_image',
    'images',
    'part_detail', 
]; 
?>
@foreach ($columns as $column)
<div class="row mt-2 pb-2 border-bottom">
    <div class="col-md-6"> 
        <label class="control-label text-capitalize">
            {{ str_replace('_', ' ', $column) }}
        </label>  
    </div>     
    
    
    @if ($column == 'category' )
        <div class="col-md-6">
            <select class="form-control  select2"  name="{{ $column }}" id="{{  $column}}">
                <option value="">Select {{ $column }}</option>
                @foreach ($categories as $item)
                <?php $category_id = isset($jdm_part )?$jdm_part->category:"";?>
                    <option  {{ $category_id == $item->id? "selected":"" }} value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div> 
    @elseif ($column == 'currency_type' )
        <div class="col-md-6">
            <select class="form-control"  name="{{ $column }}" id="{{  $column}}">
                <option value="">Currency Type</option> 
                <?php $currency_type = isset($jdm_part )?$jdm_part->currency_type:"";?>
                <option {{ $currency_type ==  "$"?" selected ":"" }}   value="$">Dollar</option> 
                <option {{ $currency_type ==  "¥"?" selected ":"" }}  value="¥">Yen </option>
            </select>
        </div> 
    @elseif ($column == 'feature_image' || $column == 'images')
        <div class="col-md-6">
            <input type="file" 
            @if ($column == 'images' )
                name="images[]" multiple
            @else
                name="{{ $column }}"
            @endif
           
              
              class="form-control">
        </div> 
    @elseif ($column == 'part_detail')
    <?php $part_detail = isset($jdm_part )?$jdm_part->part_detail:"";?>
        <textarea name="{{ $column  }}" id="" class="form-control" >{{   $part_detail }}</textarea>
    @else 
        <div class="col-md-6">
            <?php $val = isset($jdm_part )?$jdm_part->$column:"";?>
            <input class="form-control"   placeholder="{{ str_replace('_', ' ', $column) }}" 
            name="{{ $column }}" type="text" 
            value="{{$val }}"> 
        </div> 
        
    @endif
</div> 
@endforeach