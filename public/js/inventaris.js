const API = '/api/products';

// ==========================
// LOAD PRODUK
// ==========================
function loadProducts() {
    const loading = document.getElementById('loading');
    const emptyState = document.getElementById('empty-state');
    const tableBody = document.getElementById('product-table');

    loading.style.display = 'block';
    emptyState.style.display = 'none';
    tableBody.innerHTML = '';

    fetch(API)
        .then(res => res.json())
        .then(data => {
            loading.style.display = 'none';

            if (data.length === 0) {
                emptyState.style.display = 'block';
                return;
            }

            let rows = '';
            data
                .sort((a, b) => a.stock - b.stock)
                .forEach(p => {
                    rows += `
                        <tr>
                            <td class="${p.stock === 0 ? 'stock-empty' :
                            p.stock < 5 ? 'stock-low' : ''}">${p.name}</td>
                            <td class="${p.stock === 0 ? 'stock-empty' :
                            p.stock < 5 ? 'stock-low' : ''}">${p.price}</td>
                            <td class="${p.stock === 0 ? 'stock-empty' :
                            p.stock < 5 ? 'stock-low' : ''}">${p.stock}</td>
                            <td>
                                <button 
                                    type="button"
                                    onclick="sellProduct(${p.id})"
                                    class="btn-sell ${p.stock === 0 ? 'btn-disabled' : ''}">
                                    Jual
                                </button>
                                <button 
                                    type="button"
                                    onclick="deleteProduct(${p.id})"
                                    class="btn-delete"
                                >
                                    Hapus
                                </button>
                                <a href="/products/${p.id}/edit">
                                    <button type="button" class="btn-edit">Edit</button>
                                </a>
                            </td>
                        </tr>
                    `;
                });

            tableBody.innerHTML = rows;
        })
        .catch(err => {
            loading.style.display = 'none';
            console.error('LOAD ERROR:', err);
        });
}


// ==========================
// TAMBAH PRODUK
// ==========================
function addProduct() {
    const nameInput = document.getElementById('name');
    const priceInput = document.getElementById('price');
    const stockInput = document.getElementById('stock');

    if (!nameInput.value || priceInput.value <= 0 || stockInput.value < 0) {
        alert('❌ Data produk tidak valid');
        return;
    }

    fetch(API, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: nameInput.value,
            price: priceInput.value,
            stock: stockInput.value
        })
    })
        .then(res => {
            if (!res.ok) throw new Error('Gagal menambah produk');
            return res.json();
        })
        .then(() => {
            nameInput.value = '';
            priceInput.value = '';
            stockInput.value = '';
            loadProducts();
        })
        .catch(err => alert(err.message));
}

// ==========================
// JUAL PRODUK
// ==========================
function sellProduct(id) {
    const qty = prompt('Jumlah jual:', 1);

    if (!qty || qty <= 0) return;

    fetch(`/api/products/${id}/sell`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            quantity: parseInt(qty)
        })
    })
        .then(res => {
            if (!res.ok) {
                return res.json().then(data => {
                    throw new Error(data.message);
                });
            }
            return res.json();
        })
        .then(() => loadProducts())
        .catch(err => alert(err.message));
}


// ==========================
// HAPUS PRODUK
// ==========================
function deleteProduct(id) {
    if (!id) {
        alert('ID produk tidak valid');
        return;
    }

    if (!confirm('⚠️ Yakin ingin menghapus produk ini?')) return;

    fetch('/api/products/' + id, {
        method: 'DELETE'
    })
        .then(res => {
            if (!res.ok) {
                throw new Error('Gagal menghapus produk');
            }
            return res.json();
        })
        .then(data => {
            alert('🗑️ ' + data.message);
            loadProducts();
        })
        .catch(err => {
            console.error(err);
            alert(err.message);
        });
}


// ==========================
// LOAD AWAL
// ==========================
loadProducts();