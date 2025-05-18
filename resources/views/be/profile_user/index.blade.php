@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="section" style="margin: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Profil Pengguna: {{ $user->name }}</h3>
                </div>
            </div>

            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    <script>
                        // Refresh halaman setelah 2 detik untuk update foto di navbar
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    </script>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        @if($user->foto)
                                            <img src="{{ asset('storage/'.$user->foto) }}"
                                                 class="img-thumbnail rounded-circle profile-image mb-3"
                                                 style="width: 200px; height: 200px; object-fit: cover;"
                                                 id="profileImage">
                                        @else
                                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center profile-image mb-3"
                                                 style="width: 200px; height: 200px;"
                                                 id="profileImagePlaceholder">
                                                <i class="fa fa-user text-white" style="font-size: 3rem;"></i>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="btn btn-primary btn-block" for="foto">
                                                <i class="fa fa-camera me-1"></i> Ganti Foto Profil
                                                <input type="file" id="foto" name="foto" class="d-none" onchange="previewImage(this)">
                                            </label>
                                            @error('foto')
                                                <small class="text-danger d-block">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                               value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="email" id="email" name="email"
                                            value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="no_hp" class="form-label">No. HP</label>
                                        <input class="form-control" type="text" id="no_hp" name="no_hp"
                                               value="{{ old('no_hp', $user->no_hp) }}" required>
                                        @error('no_hp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="aktif" class="form-label">Status Akun</label>
                                        <select class="form-control" id="aktif" name="aktif" required>
                                            <option value="1" {{ $user->aktif == 1 ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ $user->aktif == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <input class="form-control" type="text" id="role"
                                               value="{{ ucfirst($user->jabatan) }}" readonly>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Password (Biarkan kosong jika tidak ingin mengubah)</label>
                                        <input class="form-control" type="password" id="password" name="password">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group text-end mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save me-1"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update foto di form profil
                const profileImage = document.getElementById('profileImage');
                const placeholder = document.getElementById('profileImagePlaceholder');

                if (profileImage) {
                    profileImage.src = e.target.result;
                } else if (placeholder) {
                    const parent = placeholder.parentNode;
                    const newImg = document.createElement('img');
                    newImg.src = e.target.result;
                    newImg.className = 'img-thumbnail rounded-circle profile-image mb-3';
                    newImg.style.width = '200px';
                    newImg.style.height = '200px';
                    newImg.style.objectFit = 'cover';
                    newImg.id = 'profileImage';
                    parent.replaceChild(newImg, placeholder);
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Update foto di sidebar dan navbar setelah upload berhasil
    @if(session('newImage'))
        document.addEventListener('DOMContentLoaded', function() {
            const newImage = '{{ session('newImage') }}';

            // Update di sidebar
            const sidebarImage = document.getElementById('sidebarProfileImage');
            if (sidebarImage) {
                sidebarImage.src = newImage;
            }

            // Update di navbar
            const navbarImage = document.getElementById('navbarProfileImage');
            if (navbarImage) {
                navbarImage.src = newImage;
            }

            // Update di dropdown navbar
            const dropdownImage = document.getElementById('dropdownProfileImage');
            if (dropdownImage) {
                dropdownImage.src = newImage;
            }
        });
    @endif
</script>
@endsection
