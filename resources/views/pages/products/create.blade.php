@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <strong>Tambah Barang</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('products.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">Nama Barang</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">

                    @error('name') <div class="text-mute">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="type" class="form-control-label">Type Barang</label>
                    <input type="text" name="type" id="type" value="{{ old('type') }}" class="form-control @error('type') is-invalid @enderror">
                    @error('type') <div class="text-mute">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-control-label">Description Barang</label>
                    <textarea name="description" id="description" class="form-control ckeditor @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description') <div class="text-mute">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="form-control-label">Harga Barang</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror">
                    @error('price') <div class="text-mute">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="quantity" class="form-control-label">Kuantitas Barang</label>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" class="form-control @error('quantity') is-invalid @enderror">
                    @error('quantity') <div class="text-mute">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Tambah Barang</button>
                </div>

            </form>
        </div>
    </div>
@endsection