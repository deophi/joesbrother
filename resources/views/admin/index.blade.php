@section('title', 'Dashboard')
@include('admin.header')
  <div class="grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-row justify-content-between">
          <h4 class="card-title">Daftar Antrian Booking</h4>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> Nama Pemesan </th>
                <th> Tempat </th>
                <th> Waktu </th>
                <th> Total Harga </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $r)
                <tr>
                  <td>{{ $r->biodata->nama }}</td>
                  <td>
                    @if ($r->tempat_id == NULL)
                      -
                    @else
                      {{ $r->tempat->nama }}
                    @endif
                  </td>
                  <td>{{ Carbon\Carbon::parse($r->waktu)->translatedFormat('l, d F Y - H:i')}}</td>
                  <td> Rp. {{ number_format($r->harga, 0,',','.') }} </td>
                  <td>
                    <button class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">Lihat Bukti</button>
                  </td>
                  <td width="10px">
                    <form action="{{ route('statusOrder.update', $r->id) }}" method="POST">
                      @csrf
                      @method('patch')
                      <input type="hidden" name="status" value="2">
                      <button class="btn btn-outline-warning">Konfirmasi</button>
                    </form>
                  </td>
                  <td width="5px">
                    <form action="{{ route('checkout.destroy', $r->id) }}" method="POST">
                      @csrf
                      @method('delete')
                      <button class="btn btn-outline-danger">Tolak</button>
                    </form>
                  </td>
                </tr>
                {{-- Start Modal Lihat Gambar Bukti Pembayaran --}}
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <center><img src="{{ asset('images/bukti/'.$r->bukti) }}" width="450px"></center>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- End Modal Lihat Gambar Bukti Pembayaran --}}
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-row justify-content-between">
          <h4 class="card-title">Daftar Booking Dikonfirmasi</h4>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th> Nama Pemesan </th>
                <th> Tempat </th>
                <th> Waktu </th>
                <th> Total Harga </th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pesanan as $r)
                <tr>
                  <td>{{ $r->biodata->nama }}</td>
                  <td>
                    @if($r->tempat_id == NULL)
                      -
                    @else
                      {{ $r->tempat->nama }}
                    @endif
                  </td>
                  <td>{{ Carbon\Carbon::parse($r->waktu)->translatedFormat('l, d F Y - H:i')}}</td>
                  <td> Rp. {{ number_format($r->harga, 0,',','.') }} </td>
                  <td width="10px">
                    <form action="{{ route('statusOrder.update', $r->id) }}" method="POST">
                      @csrf
                      @method('patch')
                      <input type="hidden" name="status" value="3">
                      <button class="btn btn-outline-warning">Selesai</button>
                    </form>
                  </td>
                </tr>
                <tr>
                  <th></th>
                  <th></th>
                  <th>Nama Produk</th>
                  <th>Jumlah Pesanan</th>
                </tr>
                <tr>
                  <?php
                    $order = App\Models\Transaksi_detail::where('transaksi_id', $r->id)->get();
                  ?>
                  @foreach ($order as $t)
                    <td></td>
                    <td></td>
                    <td>
                      @if($t->produk_id == NULL)
                        NULL
                      @else
                        <img src="{{ asset('images/produk/'.$t->produk->photo) }}" alt="image" />     {{ $t->produk->nama }}
                      @endif
                    </td>
                    <td>{{ $t->jumlah }}</td>
                  @endforeach
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@include('admin.footer')
