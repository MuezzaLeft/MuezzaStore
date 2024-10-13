@extends('layouts.admin.main') 
@section('title', 'Admin Flash') 
@section('content') 
<div class="main-content"> 
<section class="section"> 
<div class="section-header"> 
<h1>Flashsale</h1> 
<div class="section-header-breadcrumb"> 
<div 
class="breadcrumb-item active"><a href="{{ 
route('admin.dashboard') }}">Dashboard</a></div> 
            <div class="breadcrumb-item">Flashsale</div> 
        </div> 
      </div> 
 
      <a href="{{ route('flash.create')}}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Produk</a> 
 
        <div class="card-body"> 
            <div class="table-responsive"> 
                <table class="table table-bordered table-md"> 
                    <tr> 
                        <th>No</th> 
                        <th>Nama Produk</th> 
                        <th>Harga Original</th> 
                        <th>Harga Diskon</th> 
                        <th>Action</th> 
                    </tr> 
                    @php 
                        $no = 0 
                    @endphp 
                    @forelse ($flashes as $item) 
                        <tr> 
                            <td>{{ $no += 1 }}</td>
                            <td>{{ $item->name }}</td> 
                            <td>{{ $item->priceOriginal }} Points</td> 
                            <td>{{ $item->priceDiskon }} Points</td> 
                           
                            <td> 
          <a href="{{ route('flash.detail', $item->id) }}" class="badge badge-info">Detail</a> 
          <a href="{{ route('flash.edit', $item->id) }}" class="badge badge-warning"> Edit </a> 
          <a href="{{ route('flash.delete', $item->id) }}" class="badge badge-danger"
          data-confirm-delete="true">Hapus</a> 
                            </td> 
                        </tr> 
                    @empty 
              <td colspan="5" class="text-center">Data Produk Kosong</td> 
                    @endforelse 
                </table> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection 