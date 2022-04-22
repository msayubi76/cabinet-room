@extends('layouts.theme')
@section('title','General Setting')
 
@section('content')
<div class="page-content">
    <div class="container-fluid  ">
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">General Setting</h5>
                       @include('alertsInfo')
                       <?php  
                        $columns = [
                            'japan_rate' ,
                            'ceo_name',
                            'ceo_message',
                            'ceo_image',
                            'df_name',
                            'df_message',
                            'df_image',
                            'coordinator_name',
                            'coordinator_message',
                            'coordinator_image',  
                            'hirose_president_name',
                            'hirose_president_message', 
                            'hirose_president_image',                       
                            'head_office_address',
                            'branch_address',
                            'tel_1',
                            'tel_2',
                            'mobile_2',
                            'mobile_1',
                            'fax_1',
                            'fax_2',
                            'email_1',
                            'email_2',
                            'email_3',
                            'welcome_message',
                        ];
                        $id =$generalSetting?$generalSetting->id:"";
                    ?>
                        <div class="row">
                            <div class="col-md-8 mx-auto"> 
                                <form class="custom-validation" action="{{url('general/setting/'.encrypt($id)) }}" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}" >
                                    <input type="hidden" name="_method" value="PUT">
                                    @foreach ($columns as $column)
                                        <div class="row mt-2 pb-2 border-bottom">
                                            <div class="col-md-6"> 
                                                <label class="control-label text-capitalize">
                                                     @if ($column == 'ceo_name')
                                                     ceo sales head 
                                                    <?php $placeholder  = "ceo sales head";?>
                                                    @elseif ($column == 'ceo_message')
                                                    ceo sales head message                                                  
                                                    <?php $placeholder  = "sales head message";?> 
                                                    @elseif ($column == 'ceo_image')
                                                    ceo sales head image                                                  
                                                    <?php $placeholder  = "sales head image";?> 
                                                    @elseif ($column == 'df_name')
                                                    director founder                                                   
                                                    <?php $placeholder  = "director founder";?> 
                                                    @elseif ($column == 'df_message')
                                                    director founder message                                                   
                                                    <?php $placeholder  = "director message";?>
                                                     @elseif ($column == 'df_image')
                                                     director founder image                                                   
                                                    <?php $placeholder  = "director image";?> 

                                                    @elseif ($column == 'coordinator_name')
                                                    president                                                   
                                                    <?php $placeholder  = "president";?> 
                                                    @elseif ($column == 'coordinator_message')
                                                    president message                                                   
                                                    <?php $placeholder  = "president message";?>
                                                     @elseif ($column == 'coordinator_image')
                                                     president image                                                   
                                                    <?php $placeholder  = "president image";?> 

                                                    @elseif ($column == 'hirose_president_name')
                                                    Caribbean sales head                                                  
                                                    <?php $placeholder  = "Caribbean sales head";?> 
                                                    @elseif ($column == 'hirose_president_message')
                                                    Caribbean sales head message                                                   
                                                    <?php $placeholder  = "Caribbean sales head message";?>
                                                     @elseif ($column == 'hirose_president_image')
                                                     Caribbean sales head image                                                   
                                                    <?php $placeholder  = "Caribbean sales head image";?> 
                                                    @elseif ($column == 'mobile_1')
                                                    Mobile No Japan 
                                                    <?php $placeholder  = "Mobile No Japan";?>
                                                    @elseif ($column == 'mobile_2')
                                                    Mobile No Pakistan
                                                    <?php $placeholder  = "Mobile No Pakistan";?>
                                                    @else
                                                    {{ str_replace('_', ' ', $column) }} 
                                                    <?php $placeholder  = $column;?>
                                                    @endif
                                                    
                                                </label>  
                                            </div>
                                            

                                            @if ($column == 'df_image' || $column == 'ceo_image' || $column == 'coordinator_image'  || $column == 'hirose_president_image')
                                            <div class="col-md-6">
                                                <input type="file" name="{{ $column }}"  class="form-control">
                                            </div>

                                            @elseif ($column == 'welcome_message')
                                                <textarea rows="6" name="{{ $column  }}" id="" class="form-control" >{{  $generalSetting->$column }}</textarea>
                                            @else 
                                                <div class="col-md-6">
                                                    <input class="form-control"   placeholder="{{ str_replace('_', ' ', $placeholder) }}" 
                                                    name="{{ $column }}" type="text" 
                                                    value="{{$generalSetting->$column  }}"> 
                                                </div> 
                                                
                                            @endif
                                        </div> 
                                    @endforeach
                                    <div class="text-center mt-3">
                                        <input type="submit" value="Save" class="btn btn-primary">
                                    </div>
                                    
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->


        </div> <!-- end row -->
    </div>
</div>
@endsection
 
