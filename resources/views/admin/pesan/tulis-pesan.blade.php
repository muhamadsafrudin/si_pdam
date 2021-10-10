<?php
$i =1;
?>
@extends('template/template')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10 ">
          <!-- DIRECT CHAT -->
          <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
              <h4> Pesan : {{ $user->name }}</h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!-- Conversations are loaded here -->
              <div id="text-pesan" class="direct-chat-messages px-3" style="height: 500px;">

              </div>
              <!-- /.direct-chat-pane -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <!-- <form action="#" method=""> -->
                <div class="input-group">
                  <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                  <input type="text" autocomplete="off" autofocus name="pesan" id="pesan" placeholder="Tulis Pesan.." class="form-control">
                  <span class="input-group-append">
                    <button id="kirim-pesan" type="button" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
                  </span>
                </div>
              <!-- </form> -->
            </div>
        </div>
      </div>
    </div>
  </section>    

  <div id="url" data-url="{{ url()->full() }}" data-to="{{ $user->id }}" data-id="{{ auth()->user()->id }}"></div>
  <script>
    $(document).ready(function(){

      function TampilPesan()
      {
          var url = $('#url').data('url');
            $.getJSON(url, function(ajax){
              var pesan = ajax.pesan;
              $('#text-pesan').html('');
              if(pesan.length > 0){
                let CekPesan = '';
                $.each(pesan, function(i,data){
                    if(data.to == $('#url').data('to') && data.from == $('#url').data('id')  || data.to == $('#url').data('id') && data.from == $('#url').data('to')  ){
                          CekPesan += 'ada';
                          if(data.from == $('#url').data('id')){
                              $('#text-pesan').append(`
                                  <div class="direct-chat-msg right">
                                    <div class="direct-chat-infos clearfix">
                                      <span class="direct-chat-name float-right">` +data.name+ `</span>
                                      <span class="direct-chat-timestamp float-left">` +data.waktu+ `</span>
                                    </div>
                                      <img class="direct-chat-img" src="{{ asset('assets/dist/img/user.png') }}">
                                    <div class="direct-chat-text from" data-id="`+data.idpesan+`">
                                      ` +data.pesan+ `
                                    </div>
                                    <div id="hapus`+ data.idpesan +`" data-url="{{ url('pesan-hapus').'/`+ data.idpesan +`' }}" class="card float-right mr-3" style="width: 7rem;display:none">
                                      <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-danger btn">Hapus</li>
                                      </ul>
                                    </div>
                                    
                                  </div>
                              `)
                          }else{
                            $('#text-pesan').append(`
                                  <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                      <span class="direct-chat-name float-left">` +data.name+ `</span>
                                      <span class="direct-chat-timestamp float-right">` +data.waktu+ `</span>
                                    </div>
                                      <img class="direct-chat-img" src="{{ asset('assets/dist/img/user.png') }}">
                                    <div class="direct-chat-text">
                                      ` +data.pesan+ `
                                    </div>
                                  </div>
                              `)
                          }
                    }
                  
                }) // end loop

                if(CekPesan == ''){
                  $('#text-pesan').append(`
                        <h4 class="text-center mt-2">Tidak ada Pesan</4>
                      `)
                }

              }else{
                $('#text-pesan').append(`
                        <h4 class="text-center mt-2">Tidak ada Pesan</4>
                      `)
              }
            })
      }

      function KirimPesan()
      {
        var pesan = $('#pesan').val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
        if(pesan != ''){

          $.ajax({
            url : $('#url').data('url'),
            method : 'POST',
            data : {
              pesan  : pesan,
              _token : _token,
            },
            dataType : 'json',
            success : function(e){
              $('#pesan').val('');
                TampilPesan();
            },
            error : function(){
              console.log('proses ajax gagal');
            }

          })
        }
      }
      TampilPesan();
       var refresh = setInterval(() => {  // soal
        TampilPesan();
      }, 1000);

      $('#kirim-pesan').click(function(){
          KirimPesan();
      });
      
     $('#pesan').on('keypress',function(e) {
          if(e.which == 13) {
              KirimPesan();
          }
      });
   
      $("#text-pesan").on('click', '.from', function(){
        let id = $(this).data('id');
        $("#hapus"+id).show();
        clearInterval(refresh);
      
        $("#hapus"+id).click(function(){
          $.ajax({
            url : $(this).data('url'),
            method : 'get',
            success : function(berhasil){
             var refresh = setInterval(() => { 
                    TampilPesan();
                  }, 1000);
            }
          })
        })
      })


      
    });
  </script>
@endsection