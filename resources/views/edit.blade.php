@extends('layout')

@section('content')
<h2>Edit Produk</h2>

<div class="inventaris-container">

    {{-- FORM EDIT --}}
    <div class="form-produk">
        <h4>Edit Data Produk</h4>

        <form method="POST" action="/products/{{ $product->id }}/update">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $product->name }}" required>
            <input type="number" name="price" value="{{ $product->price }}" required>
            <input type="number" name="stock" value="{{ $product->stock }}" required>

            <button type="submit">Update</button>
            <a href="/inventaris">
                <button type="button">Batal</button>
            </a>
        </form>
    </div>

    {{-- TABEL INVENTARIS --}}
    <div class="table-produk">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->price }}</td>
                    <td>{{ $p->stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
