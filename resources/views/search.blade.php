@extends('layouts.app')
@section('content')
<section id="contact" class="contact">
  <div class="contact-area">
    <!-- Google Map Section -->

    <div id="message-details" class="message-details">
      <div class="container">
        <form action="/search" method="GET" id="myForm" class="message-form">
          <div class="row">
            <div class="col-sm-6">
              <input id="author" class="form-control" name="key" type="text" value="" size="30" aria-required="true" placeholder="Kata Kunci Pencarian" title="Name" required="">
              
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select class="form-control" id="sel1" name="id_service" aria-required="true" required>
                  <option value="">== Kategori Data ==</option>
                  @foreach ($services as $service)
                      <option value="{{$service['_id']}}">{{$service['nama_service']." (".$service['penyedia'].")"}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <button name="submit" class="btn full-width" type="submit" id="submit">Submit</button>
            </div>
          </div><!-- /.row -->
        </form><!-- /#commentform -->
        <hr>
        @if(isset($data))
        <div class="post-area">
          <div class="post-area-top text-center">
            <h2 class="post-area-title">Hasil Pencarian</h2>
          </div><!-- /.post-area-top -->
        <div class="row">
        <div class="latest-post">
        @foreach ($data as $result)
        <div class="col-sm-12">
            <div class="item">
              <article class="post type-post">
                <div class="post-content">
                  <div class="table-responsive">
                    
                    <table class="table">
                    @if(is_object($result))
                      @if(isset($result->data))
                        @php
                          $arrayRs = $result->data;
                        @endphp
                      @elseif (isset($result->metadata))
                        @php
                          $arrayRs = $result->metadata;
                        @endphp
                      @endif
                    @elseif(is_array($result))
                      @if(isset($result['data']))
                        @php
                          $arrayRs = $result['data'];
                        @endphp
                      @elseif (isset($result['metadata']))
                        @php
                          $arrayRs = $result['metadata'];
                        @endphp
                      @endif
                    @endif
                    

                    @foreach($arrayRs as $key => $value)
                    <tr>
                      <td>
                        {!!trim($key)!!}
                      </td>
                      <td>
                        :
                      </td>
                      <td>
                        @if(is_object($value) or is_array($value))
                          @foreach($value as $key2 => $value2)
                          <ul>
                            <li>
                              {!!$key2." : ".$value2!!}
                            </li>
                          </ul>
                          @endforeach
                        @else
                        {!!$value!!}
                        @endif
                      </td>
                    </tr>
                    @endforeach
                    </table>
                  </div>
                </div><!-- /.post-content -->
              </article>
            </div><!-- /.item -->
          </div>
          @endforeach

          {{$data->render()}}
          </div>  
          </div>
          </div>
          @endif
      </div><!-- /.container -->
    </div><!-- /.message-details -->
  </div><!-- /.contact-area -->
</section> 
@endsection