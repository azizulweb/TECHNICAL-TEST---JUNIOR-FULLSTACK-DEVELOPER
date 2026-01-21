@extends('layout')

@section('content')
    <h2>Manajemen User</h2>

    <div class="table-produk">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="user-table"></tbody>
        </table>
    </div>

    <script>
        function loadUsers() {
            fetch('/api/users')
                .then(res => res.json())
                .then(data => {
                    let rows = '';
                    data.forEach(u => {
                        rows += `
                    <tr>
                        <td>${u.name}</td>
                        <td>${u.email}</td>
                        <td>
                            <select id="role-${u.id}">
                                <option ${u.role=='Admin'?'selected':''}>Admin</option>
                                <option ${u.role=='Seller'?'selected':''}>Seller</option>
                                <option ${u.role=='Customer'?'selected':''}>Customer</option>
                            </select>
                        </td>
                        <td>
                            <button onclick="saveRole(${u.id})">Simpan</button>
                        </td>
                    </tr>`;
                    });
                    document.getElementById('user-table').innerHTML = rows;
                });
        }

        function saveRole(id) {
            const role = document.getElementById(`role-${id}`).value;

            fetch(`/api/users/${id}/change-role`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    role
                })
            }).then(() => alert('Role berhasil diubah'));
        }

        loadUsers();
    </script>
@endsection
