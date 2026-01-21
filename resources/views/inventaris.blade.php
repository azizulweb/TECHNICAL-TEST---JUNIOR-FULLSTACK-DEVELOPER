@extends('layout')

@section('content')
    <h2>Inventaris Barang</h2>
    <div class="inventaris-container">

        <!-- FORM TAMBAH PRODUK (KIRI) -->
        <div class="form-produk">
            <h4>Tambah Produk</h4>
            <input type="text" id="name" placeholder="Nama">
            <input type="number" id="price" placeholder="Harga">
            <input type="number" id="stock" placeholder="Stok">
            <button onclick="addProduct()" class="btn-primary">Tambah</button>
        </div>

        {{-- FORM EDIT --}}
        <div id="form-edit" style="display:none;">
            <h4>Edit Produk</h4>
            <input type="text" id="edit-name" placeholder="Nama">
            <input type="number" id="edit-price" placeholder="Harga">
            <input type="number" id="edit-stock" placeholder="Stok">

            <button onclick="updateProduct()" class="btn-edit">Update</button>
            <button onclick="cancelEdit()" class="btn-delete">Batal</button>
        </div>

        <!-- TABEL INVENTARIS (KANAN) -->
        <div class="table-produk">

            {{-- Loading Indicator --}}
            <p id="loading" style="display:none;">⏳ Memuat data produk...</p>

            {{-- Empty State --}}
            <p id="empty-state" style="display:none;">📦 Belum ada produk</p>

            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="product-table">
                    {{-- DATA DIISI OLEH JAVASCRIPT --}}
                </tbody>
            </table>

        </div>
    </div>

    <script src="{{ asset('js/inventaris.js') }}"></script>
@endsection
