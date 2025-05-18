@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container" style="margin: 20px;">
    <h2>Daftar Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
        Tambah User
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr class="border-bottom">
                            <th class="py-3">No</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">Nomor HP</th>
                            <th class="py-3">Jabatan</th>
                            <th class="py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                        <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-light' }} border-bottom">
                            <td class="py-3">{{ $loop->iteration }}</td>
                            <td class="py-3"><strong>{{ $user->name }}</strong></td>
                            <td class="py-3">{{ $user->email }}</td>
                            <td class="py-3">{{ $user->no_hp }}</td>
                            <td class="py-3">{{ $user->jabatan }}</td>
                            <td class="py-3">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Belum ada data user.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
